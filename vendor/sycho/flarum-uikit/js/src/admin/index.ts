// Expose compat API
import customCompat from './compat';
// @ts-ignore
import { compat } from '@flarum/core/admin';

Object.assign(compat, customCompat);
