{!! $translator->trans($blueprint->getTranslation().'.body', [
'{warnee_display_name}' => $user->display_name,
'{warner_display_name}' => $blueprint->warning->addedByUser->display_name,
'{strikes}' => $blueprint->warning->strikes,
'{discussion_title}' => $blueprint->warning->post ? $blueprint->warning->post->discussion->title : '',
'{public_comment}' => $blueprint->getUnparsedComment()
]) !!}
