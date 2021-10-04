<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'user_loggedin_successfully' => 'User Logged in successfully.',
    'login_error' => [
		'invalid_credentials' => 'Invalid Credentials. Please try again.',
		'login_failed' => 'Login Failed! Please try again',
		'account_deactivated' => 'Your account is deactivated. Please request admin for activate it.',
		'email_not_verified' => 'Your email is not verified. Please check your mail for verify your account.',
		'account_not_approved_by_admin' => 'Your account is not approved by admin. Please request admin for approve it.'
	],
	'verify' => [
		'activated' => 'Your account is activated now.',
		'already_verified' => 'Your e-mail is already verified.',
		'email_not_identified' => 'Sorry, your email cannot be identified.',
		'invalid_token' => 'Invalid Token.'
	],
	'invalid_coupon' => 'Invalid Coupon.',
	'user_registered_successfully' => 'You have registered successfully. Please check your mail to activate your account.',
	'user_signup_failed' => 'User not Added, please try again.',
	'no_record_found_with_email' => 'No record found with this email. Please try again.',
	'check_mail_for_passcode' => 'Please check your mail for passcode.',
	'passcode_vefified_successfully' => 'OTP Verified successfully.',
	'passcode_mismatch' => 'OTP mismatch. Please try again.',
	'email_not_found' => 'Email not found. Please try again.',
	'password_changed_successfully' => 'Password changed successfully',
	'user_updated_successfully' => 'User updated successfully',
	'user_update_failed' => 'Could not update user. Please try again',
	'logged_out_successfully' => 'User logged out successfully',
	'already_a_follower' => 'Already a follower of this user',
	'some_error_occured' => 'Some error occured. Please try again',
	'follow_successfully' => 'User started following successfully',
	'unfollow_successfully' => 'Unfollow successfully',
	'can_not_follow_himself' => 'User can not follow himself',
	'invalid_input' => 'Invalid Input',
	'no_record_found' => 'No record found. Please try again.',
	'invalid_record' => 'Invalid record. Please try again.',
	'already_liked' => 'You have already liked this shoutout.',
	'liked_successfully' => 'You have liked this shoutout.',
	'comment_made_successfully' => 'Comment posted successfully.',
	'unlike_successfully' => 'You have unliked this shoutout.',
	'can_not_like_on_his_shoutout' => 'You can not like on your own shoutout.',
	'can_not_comment_on_his_shoutout' => 'You can not comment on your own shoutout.',
	'comment_deleted_successfully' => 'Comment deleted successfully.',
	'review_submit_successfully' => 'Your review has been submitted successfully',
	'already_review_submitted' => 'You have already reviewed on this shoutout.',
	'can_not_review_himself' => 'You can not post review on your own shoutout.',
	'not_able_to_delete' => 'You can only delete your own comment.',
	'report_made_successfully' => 'Your report is posted successfully.',
	'artist_enrolled_successfully' => 'Celebrity Enrollment Request has been saved successfully. Admin will approve your account',
	'artist_enrolled_failed' => 'Celebrity not Added, please try again.',
	'invalid_artist' => 'Invalid Celebrity.',
	'invalid_user' => 'Invalid User.',
	'update_after_admin_approval' => 'Your request has been sent to admin. Once admin approved, changes will be refect on your account.',
	'request_pending_to_admin' => 'Your request already pending with Admin',
	'email_already_exists' => 'The email has already been taken.',
	'booking_made_successfully' => 'Booking has been added successfully.',
	'booking_could_not_saved' => 'Booking could not made, please try again.',
	'booking_approved_successfully' => 'Successfully Approved',
	'booking_rejected_successfully' => 'Successfully Rejected',
	'booking_error' => [
		'already_approved_or_rejected' => 'This booking is already approved or rejected',
		'belongs_to_invalid_artist' => 'Booking is not belong to this Celebrity',
		'invalid_artist' => 'Not a valid Celebrity',
		'can_not_book_self' => 'You can not book yourself',
		'artist_is_not_accepting_new_bookings' => 'Celebrity is unavailable now and he is not accepting new bookings',
		'not_enough_balance' => 'You have not enough balance',
	],
	'shoutout_made_successfully' => 'Shoutout has been added successfully.',
	'shoutout_could_not_saved' => 'Shoutout could not made, please try again.',
	'shoutout_error' => [
		'video_not_uploaded' => 'Video not uploaded',
		'booking_not_approved' => 'Booking is not approved for shoutout',
		'belongs_to_invalid_artist' => 'Booking is not belong to this Celebrity',
		'invalid_artist' => 'Not a valid Celebrity',
	],
	'email_already_exists' => 'The email has already been taken.',
	'payment_made_successfully' => 'Payment has been successfully made.',
	'payment_could_not_saved' => 'Payment could not be saved.',
    'Facebook' => 'Faceboook',
    'Twitter' => 'Twitter',
    'Instagram' => 'Instagram',
    'Youtube' => 'Youtube',
    'Twitch' => 'Twitch',
    'Tiktok' => 'Tiktok',
    'Other' => 'Other',
	'all' => 'All',
	'booking_rate_asc' => 'Booking rate: Low to High',
	'booking_rate_desc' => 'Booking rate: High to Low',
	'artist_name_asc' => 'Name: A to Z',
	'artist_name_desc' => 'Name: Z to A',
	
	'sexual_content' => 'Sexual content',
	'violent_or_repulsive_content' => 'Violent or repulsive content',
	'hateful_or_abusive_content' => 'Hateful or abusive content',
	'harmful_or_dangerous_act' => 'Harmful or dangerous act',
	'spam_or_misleading' => 'spam or misleading',
	
	'notifications' => [
		'booking_done_title' => 'You have received a booking request',
		'booking_done_msg' => 'You have received a booking request from :name',
		'booking_approved_title' => 'Your booking request has been approved',
		'booking_approved_msg' => 'Your booking request has been approved',
		'booking_rejected_title' => 'Your booking request has been rejected',
		'booking_rejected_msg' => 'Your booking request has been rejected',
		'booking_completed_title' => 'Your booking request has been completed',
		'booking_completed_msg' => 'Your booking request has been completed',
		'shoutout_unliked_title' => 'Your shoutout has been unliked',
		'shoutout_unliked_msg' => 'Your shoutout has been unliked by :name',
		'shoutout_liked_title' => 'Your shoutout has been liked',
		'shoutout_liked_msg' => 'Your shoutout has been liked by :name',
		'shoutout_comment_title' => 'Your shoutout has received a comment',
		'shoutout_comment_msg' => 'Your shoutout has received a comment',
	],
	
	'featured' => 'Featured',
	'about_link' => 'About',
	'faq_link' => 'FAQ',
	'privacy_link' => 'Privacy',
	'terms_link' => 'Terms',
	'support_link' => 'Support',
	'contact_link' => 'Contact',
	'how_it_works' => 'HOW IT WORKS',
	'get_in_touch' => 'Get in Touch',
	'send_us_a_message' => 'Send us a message',
	'contact_page_labels' => [
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'email' => 'Email *',
		'contact_no' => 'Contact No.',
		'message' => 'Message',
		'send_message' => 'Send Message',
	],
	'contact_page_success_msg' => 'Your message has been successfully sent. We will contact you very soon!',
	'copyright_text' => 'All Rights Reserved.',
	'recaptcha_unknown_error' => 'Some error occurred. Please try again',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
