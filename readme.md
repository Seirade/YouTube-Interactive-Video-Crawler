# YouTube Interactive Video Crawler

A little script that uses [youtube-dl](https://rg3.github.io/youtube-dl/) to download unlisted YouTube videos that are linked to in another (public) video's annotations. Useful for grabbig sub-videos that are parts of "choose your own adventure" interactive videos, navigation menus, or any other collections.

## Requirements
- [PHP 7](http://php.net/) or higher (the built-in web server is fine to use)
- [youtube-dl](https://rg3.github.io/youtube-dl/) for downloading videos
- A modern web browser: [Mozilla Firefox 64](https://www.mozilla.org/en-US/firefox/new/) or [Google Chrome 70](https://www.google.com/chrome/) are recommended

## How to use
If you're on Windows, you can get it over on the [Releases](https://github.com/Seirade/YouTube-Interactive-Video-Crawler/releases) page.

There will be a bare-minimum copy of PHP bundled with it and a batch file to launch the server for you. Simply double-click the `php.bat` and nagivate your browser to http://127.0.0.1:1337/crawl.php. Once you're on the page, type the ID of a video you wish to download, and it will continue finding more videos to download. When it's done, it will dump a list of everything it downloaded and where it's located

## :warning: Tips and warnings
- The directory structure for this tool is the same as the [YouTube Annotation Player](https://github.com/Seirade/YouTube-Annotation-Player)'s, so feel free to merge the two together
- Since I rushed this script out, it's not that polished. There won't be any visual feedback aside from maybe a spinning favicon. You'll need to monitor the `Videos` folder if you want to check up on progress. That said, the core functionality works fine, and there shouldn't be any major bugs
- Some creators often linked to their other videos by using annotataions to act as Previous and Next buttons. Careful about pointing to any videos like that unless you're sure about it

## Contributing
This is just a one-off utility, so I'm not too concerned about code updates. I do encourage you to use this though, and helping the Youtube Annotation Archive project. The more the merrier! Please join the project over on Discord: https://discord.gg/HcjZKdR