Hey {!! $user->display_name !!}!

{!! $blueprint->getEmailSubject() !!}

The following reason was given:

---

{!! $blueprint->warning->public_comment !!}
