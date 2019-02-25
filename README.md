# Drum Transcriber

Drum Transcriber is an open source (with a [public repository](https://github.com/Wcashman1351/Drum_Transcriber_ASC) on git hub), internet-enabled musical development system which assists the user in transcribing and publishing personal drum compositions without any expensive or invasive equipment. 

Detailed implementation can be accessed from [Zoey Chen](https://cs.anu.edu.au/courses/china-study-tour/news/#zoey-chen) and [William Cashman](https://cs.anu.edu.au/courses/china-study-tour/news/#william-cashman)'s blog posts.

## Where This Came From
> It was a hot summer afternoon, a girl was practicing drums in the music room all alone. The temperature kept climbing and the girl was soaking wet but she kept going. She swang slower and slower and her brain was turning off. Suddenly, a cool breeze came in. The girl woke up, she hits the drums hard and nice in an upbeat mood. “That is beautiful. Which music did you play?” A sweet voice came from her back, from the kind stranger who brought in the breeze - it was a girl her age with big eyes filled with joy. “Ugh…” she tries to remember but the feeling was gone, “it was a random sparkle and it is gone.” The end.

What if the drum girl had something that could record her performance? Would the story be totally different? Those two girls can happily share the music the drum girl played and listen to it over and over again!

This is where the idea of Drum Transcriber came from. An artefact that would save all the sparkles the music creator comes across when they are creating new music. An artefact that would connect people both friends and strangers through music. And that's why people care about this project.

## New Features!

  - Drum hits detection 
  - Drum notes graphical presentation
  - Interactive UI
  - Fast WiFi transmission

## Example:

Here is an example of output music bar:
[Insert Image]

## Installation
### Physical requirements
- ESP32-PICO-KIT (~$8)
- Minisense 100 vibration sensor (horizontal) (~$5)
- Jumper wires
- Breadboard (optional)
- USB-micro to x (x is the type of connector on your local machine) (optional, only if you want to see the printed results on your local machine)

Attach the sensor onto the counter hoop of the drum, then connect the sensor to ESP32-PICO-KIT's IO34 and GND pins using jumper wires.

### Software requirements
#### For Micro-controller (ESP32-PICO-KIT)
Download and install Arduino IDE from [Arduino.cc](https://www.arduino.cc/en/main/software).
Upload the file in Transcriber folder to ESP32 using Arduino IDE.

With this part of code and the physcial set up, you will be able to see the hit detection on your local machine that is connected via cable to the ESP32. With the server set up we can see the generated notes on the server, which would be transmitted from the ESP32 to the server via WiFi (this step does not require the USB-micro to x cable). In the example [here](https://www.youtube.com/watch?v=5dQSTG8rNU4) we used [Serial_Plotter](https://gitlab.com/2b-a2/serial-plotter) to present the hits graphically.

#### For Web Server 
This project is intended to run on a single remote webserver, however, since the project is still in the early stages of development (when compared to a product you would actually deploy) it might be convenient to host your own version of the webserver on your device. 

To allow your personal device to act as a webserver:
1. Setup Apache2.0, MySQL and PHP on your device: [MacOS](https://websitebeaver.com/set-up-localhost-on-macos-high-sierra-apache-mysql-and-php-7-with-sslhttps), [Windows](https://www.znetlive.com/blog/how-to-install-apache-php-and-mysql-on-windows-10-machine/), [Linux](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04).
2. 
## Development
Drum Transcriber is open to push requests! 

Contact us at u6374918@anu.edu.au (Will) or zhuo.chen1@anu.edu.au (Zoey).

## Todos

- (UI) Enable newsfeed, more interactive, more aesthetic.
- (Raw data and analyse) Use microphone to read in sound wave and do fourior transform on it to determine if hit or not.
- (Network/Wireless transmission) Use TCP to transmit the data directly between the micro-controller and the server instead of transmit via HTTP calls.
- (Drum Technique Detection) Rolling can be detected by setting a limit and when the hits per unit time is faster than the limit, then all the hits would be recorded as a roll.
- (Noise Cancellation, sensor) Apply an active low-pass filter design on the vibration sensor using operational amplifiers.
- (Noise Cancellation, math) Decrease the strength of 4PHD, or, make the noise filter more general.
- ......


License
----

MIT


**Have Fun With Creating New Music!!**

[//]: # (References)


   [William Cashman Blog Post]: <https://cs.anu.edu.au/courses/china-study-tour/news/#william-cashman>
   [Zoey Chen Blog Post]: <https://cs.anu.edu.au/courses/china-study-tour/news/#zoey-chen>
   [Serial Plotter]: <https://gitlab.com/2b-a2/serial-plotter>
   [Drum Transcriber Test]:<https://www.youtube.com/watch?v=5dQSTG8rNU4>

