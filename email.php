<?php
mb_language("uni");
$body = chunk_split(base64_encode("International characters"));
mb_send_mail("someone@example.com", "Subject", $body);