<p>Hi,</p>

<p>
    PentesterSpace has invited you to access their account. <br>
    Your credentials for reporting panel is <br>
    Email: "{{ $invite->email }}" <br>
    Password: "{{ $invite->password }}"
</p>

<a href="{{ route('accept', $invite->token) }}">Click here</a> to activate
