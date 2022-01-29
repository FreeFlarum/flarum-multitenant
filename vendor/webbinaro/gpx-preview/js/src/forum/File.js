import app from 'flarum/app';
import Model from 'flarum/common/Model';
import mixin from 'flarum/common/utils/mixin';

export default class File extends mixin(Model, {
    baseName: Model.attribute('baseName'),
    path: Model.attribute('path'),
    url: Model.attribute('url'),
    type: Model.attribute('type'),
    size: Model.attribute('size'),
    humanSize: Model.attribute('humanSize'),
    createdAt: Model.attribute('createdAt'),
    uuid: Model.attribute('uuid'),
    tag: Model.attribute('tag'),
    hidden: Model.attribute('hidden'),
}){


    /**
     * Use FoF Uploads endpoint
     */
    apiEndpoint() {
        return '/fof/uploads' + (this.exists ? '/' + this.data.id : '');
    }

    /**
     * Generate bbcode for this file
     */
    bbcode() {
        console.log('checking')
        console.log(this.tag())
        switch (this.tag()) {
            // THis is obviouslu not sustainable and the backend API should return thus bb (which is already defined) in the provider php
            case 'gpx':
                return `[upl-file uuid=${this.uuid()} size=${this.humanSize()} url=${this.url()}]${this.baseName()}[/upl-file]`;
            // File
            case 'file':
                return `[upl-file uuid=${this.uuid()} size=${this.humanSize()}]${this.baseName()}[/upl-this]`;

            // Image template
            case 'image':
                return `[upl-image uuid=${this.uuid()} size=${this.humanSize()} url=${this.url()}]${this.baseName()}[/upl-image]`;

            // Image preview
            case 'image-preview':
                return `[upl-image-preview url=${this.url()}]`;

            // 'just-url' or unknown
            default:
                return this.url();
        }
            
    }


}
