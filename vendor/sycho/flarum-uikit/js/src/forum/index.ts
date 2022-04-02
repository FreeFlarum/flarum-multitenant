// Expose compat API
import customCompat from './compat';
// @ts-ignore
import { compat } from '@flarum/core/forum';

Object.assign(compat, customCompat);
