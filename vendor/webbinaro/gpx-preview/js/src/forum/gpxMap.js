import app from 'flarum/app';
import {extend} from 'flarum/extend';
import Post from 'flarum/components/Post';
import GPXParser from './GPXParser';

/* global $ */

export default function () {
    extend(Post.prototype, 'oncreate', function () {
        let postId = this.attrs.post.id();
        
        function loadGPXFileIntoGoogleMap(map, filename) {
            $.ajax({url: filename,
                dataType: "xml",
                success: function(data) {
                  console.debug("parsing GPS file " + filename);
                  var parser = new GPXParser.GPXParser(data, map);
                  parser.setTrackColour("#ff0000");     // Set the track line colour
                  parser.setTrackWidth(5);          // Set the track line width
                  parser.setMinTrackPointDelta(0.001);      // Set the minimum distance between track points
                  parser.centerAndZoom(data);
                  parser.addTrackpointsToMap();         // Add the trackpoints
                  parser.addRoutepointsToMap();         // Add the routepoints
                  parser.addWaypointsToMap();           // Add the waypoints
                }
            });
        }

        //for each gpx file in this post, loop and map
        this.$('.gpxFile').each(function( i ) {
          //console.log(this); //'this' is now a matching div with our URL and UUID
          //let url = $(this).data('mapUrl');
          let url = app.forum.attribute('apiUrl') + '/fof/download';
            url += '/' + $(this).data('fofUploadDownloadUuid');
            url += '/' + postId;
            url += '/' + app.session.csrfToken;
          let mapId = 'map-' + $(this).data('fofUploadDownloadUuid');
          console.debug(url);
          console.debug(mapId);

          var mapOptions = {
            zoom: 8,
            mapTypeId: 'roadmap'
          };
          var map = new google.maps.Map(document.getElementById(mapId),mapOptions);
          loadGPXFileIntoGoogleMap(map, url);
        });

    });
}
