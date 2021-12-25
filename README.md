# WebMPC

The simplest mpc web UI for playing internet radio.

Tested on Raspberry Pi 1 Model B with [ArchLinux ARM](https://archlinuxarm.org) + [Lighttpd](https://www.lighttpd.net).

## Requirements

* Any web server
* PHP >= 7.2
* PHP JSON extension
* mpc client

# Dependencies

* [Semantic-UI](https://github.com/Semantic-Org/Semantic-UI)

## Installation

1. Copy contents of src to web server root folder.
2. Edit `json/radio.json` providing links to your favorite radio streams and local logo images.
3. Copy logo images to `images` folder.

## License

Apache 2.0. See LICENSE for details.
