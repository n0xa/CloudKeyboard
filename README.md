# CloudKeyboard
Use Particle IoT development boards (e.g. Electron, Photon) as a cloud-controlled HID device 

## particle
This directory contains the CloudKeyboard sketch that you must compile and flash to the Particle device of your choice. You can do this through the Particle IDE or download the firmware and use the Particle CLI.

## client
This is a mess of mostly PHP code that can be used to automate HID payloads. You can manually perform most operations through the Particle device console without relying on the client tools. You must generate and configure your user access token with the particle CLI tool in order to use the client code.
