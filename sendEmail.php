<?php
require 'vendor/autoload.php';
use \Mailjet\Resources;

$mj = new \Mailjet\Client('de5b01318fcb185ab14b2a1658664399', '5b30019a4455b7b8b025bdbbd5cdb88f', true, ['version' => 'v3.1']);
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "negreacatalin27@gmail.com",
                'Name' => "Catalin"
            ],
            'To' => [
                [
                    'Email' => "negreaflorina366@yahoo.com",
                    'Name' => "Florina"
                ]
            ],
            'Subject' => "Your email subject",
            'TextPart' => "Your email text content",
            'HTMLPart' => "<h3>Your email HTML content</h3><br />With Mailjet!"
        ]
    ]
];

$response = $mj->post(Resources::$Email, ['body' => $body]);
if($response->success()) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>
