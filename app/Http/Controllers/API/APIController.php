<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use Response;

/**
 * Base API Controller.
 */
class APIController extends Controller
{
    /**
     * default status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * get the status code.
     *
     * @return statuscode
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * set the status code.
     *
     * @param [type] $statusCode [description]
     *
     * @return statuscode
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Respond.
     *
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data) {
        return response()->json($data);
    }

    /**
     * respond with pagincation.
     *
     * @param Paginator $items
     * @param array     $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithPagination($items, $data) {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $items->total(),
                'total_pages' => ceil($items->total() / $items->perPage()),
                'current_page' => $items->currentPage(),
                'limit' => $items->perPage(),
            ],
        ]);

        return $this->respond($data);
    }

    /**
     * Respond Created.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($data) {
        return $this->respond($data);
    }

    /**
     * Respond Created with data.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreatedWithData($data) {
        return $this->setStatusCode(201)->respond($data);
    }

    /**
     * respond with error.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message) {
        $test = new \stdClass();
        return $this->respond([
			'statusCode' => $this->statusCode,
			//'is_register' => 0,
			'message' => $message,
			'data' => $test,
        ]);
    }

    /**
     * responsd not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found') {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * Respond with error.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal Error') {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized') {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden') {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * Respond with no content.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithNoContent() {
        return $this->setStatusCode(204)->respond(null);
    }

    /*     * Note this function is same as the below function but instead of responding with error below function returns error json
     * Throw Validation.
     *
     * @param string $message
     *
     * @return mix
     */

    public function throwValidation($message) {
        return $this->setStatusCode(400)->respondWithError($message);
    }
	
	public function pushNotificationIOS($title, $message, $deviceToken, $notifyType, $args = array(), $badgeCount = 0) {
		if($deviceToken == '') {
			return false;
		}
        $passphrase = 'admin@123';
		$pem = public_path('/pem/ck.pem');
		
		$production = 1;
		if ($production) {
			$gateway = 'gateway.push.apple.com:2195';
		} else { 
			$gateway = 'gateway.sandbox.push.apple.com:2195';
		}
		
		// Create a Stream
		$ctx = stream_context_create();
		// Define the certificate to use 
		stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);
		// Passphrase to the certificate
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client('ssl://'.$gateway, $err, $errstr, 60,  STREAM_CLIENT_CONNECT, $ctx);		
		
		$payload = "";		
		$setFlag = 1;
		//$badgeCount = 2;
		
		//$payload = '{"aps": {"alert": "'.$title.'", "badge":'.$badgeCount.', "sound": "default", "message": "'.$message.'"}}';
        $body['aps'] = array(
			'alert' => array(
			    'title' => $title,
                'body' => $message,
			),
			//'category' => $notifyType,
			'sound' => 'default'
		);
		// Encode the payload as JSON
		$payload = json_encode($body);
			
		if($payload!="") {		
			if(!$fp) {
				$setFlag = 0;
				//echo("Failed to connect (1) $err $errstr");						
			}
			$msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
			$result = fwrite($fp, $msg);
		
			if (!$result) {
				//fclose($fp);
				sleep (3);
				$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60,  STREAM_CLIENT_CONNECT, $ctx);
				if(!$fp) {
					$setFlag = 0;
					//echo("Failed to connect (2): ".$err." ".$errstr.PHP_EOL);
				}
                $setFlag = 0;
			}
		}
		fclose($fp);			
		return $setFlag;
	}
}