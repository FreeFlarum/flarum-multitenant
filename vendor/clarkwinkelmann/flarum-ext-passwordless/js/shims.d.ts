// We need to import this class here for the PhpStorm TS features to continue working
import LogInModal from 'flarum/forum/components/LogInModal';

declare module 'flarum/forum/components/LogInModal' {
    export default interface LogInModal {
        passwordlessTokenSent?: boolean
        passwordlessSkip?: boolean

        requestPasswordlessToken(event: Event): void
    }
}
