<div>
    Hello {{ $email_data['name'] }}
    <br />
    Welcome to the site. Please follow the link below to complete your registration:
    <br />
    <a class="btn btn-primary" href="{{ env('APP_URL2') . 'verify?code=' . $email_data['verification_code'] }}">Verification
        Token </a>
    <br />
    Thanks for registering!
</div>
