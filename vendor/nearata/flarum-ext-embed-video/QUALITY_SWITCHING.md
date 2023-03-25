# Quality Switching

There's no wizard to add quality switching, you have to do this manually.

## Admin

The Quality Switching is disabled by default, you can enable it in the `admin panel`.

## Format

```bash
qualities='<name>;<url>;<type:optional>'
```

## Parameters

- `name`: The name that will be displayed on the player.
- `url`: The URL of the video.
- `type`: The video type. (optional)

## Video types

- `auto`
- `hls`
- `flv`
- `dash`
- `webtorrent`
- `normal`

## Usage

```bash
# type not specified, default to `auto`
[embed-video id='12345' url='https://example.com/video.mp4' type='normal' live='false' qualities='sd;https://example.com/video.m3u8']

# type specified, `hls`
[embed-video id='12345' url='https://example.com/video.mp4' type='normal' live='false' qualities='sd;https://example.com/video.m3u8;hls']

# we can also do this, better formatting
[embed-video id='12345' url='https://example.com/video.mp4' type='normal' live='false' qualities='
sd;https://example.com/video_sd.m3u8,
hd;https://example.com/video_hd.m3u8;hls
']

# does not show the `default` quality
[embed-video id='12345' url='' type='normal' live='false' qualities='
sd;https://example.com/video_sd.m3u8,
hd;https://example.com/video_hd.m3u8;hls
']
```

## Known issues

The `dash` video type is not supported. (partially confirmed, only me)
