// Cloud Keyboard -- For Particle.io Electron/Photon
// Like a Cloud-connected Teensy that you can control in real time over the Internet
// 2019 - Ax0n (at) H-i-R.Net 

//https://community.particle.io/t/split-string-into-array-of-string/37922/8
const unsigned int BUFFER_SIZE = 64;  // Maximum of 63 chars in an argument. +1 to include null terminator
char paramBuf[BUFFER_SIZE];  // Pre-allocate buffer for incoming args


void setup() {
    // Starts Particle HID Keyboard mode
    Keyboard.begin();
    // Announce Particle Functions to call keyboard activities
    Particle.function("kb",kb);
    Particle.function("scancode",keyp);
    Particle.function("shft",shft);
    Particle.function("win",win);
    Particle.function("alt",alt);
    Particle.function("ctl",ctl);
    Particle.function("ctlalt",ctlalt);
    Particle.function("sm",sm);
}

void loop() {
    // Main loop just waits for a keyboard function to be called
}


int kb(String txt){
    // Types the text passed via the "kb" function (with a return)
    Keyboard.println(txt);
    Particle.publish("kb",txt);
    return(0);
}

int keyp(String keyp){
    // Sends a single keystroke by scancode. You have to convert the hex values to decimal.
    // https://github.com/particle-iot/device-os/blob/develop/wiring/inc/spark_wiring_usbkeyboard_scancode.h
    Keyboard.click(keyp.toInt());
    Particle.publish("scancode",keyp);
    return(0);
}

int shft(String keyp){
    // Sends "Shift+scancode"
    Keyboard.click(keyp.toInt(), MOD_LSHIFT);
    Particle.publish("shft",keyp);
    return(0);
}

int win(String keyp){
    // Sends "Win+scancode" (e.g. Win+R = Run menu hotkey) 
    Keyboard.click(keyp.toInt(), MOD_LGUI);
    Particle.publish("win",keyp);
    return(0);
}

int alt(String keyp){
    // Sends "Alt+scancode" 
    Keyboard.click(keyp.toInt(), MOD_LALT);
    Particle.publish("alt",keyp);
    return 0;
}

int ctl(String keyp){
    // Sends "Ctrl+scancode"
    Keyboard.click(keyp.toInt(), MOD_LCTRL);
    Particle.publish("ctl",keyp);
    return 0;
}

int ctlalt(String keyp){
    // Sends "Ctrl+Alt+scancode"
    Keyboard.click(keyp.toInt(), MOD_LALT | MOD_LCTRL);
    Particle.publish("ctlalt",keyp);
    return 0;
}

int sm(String evil){
    // WIP. I'm hoping to replace all of the above junk with something that
    // can handle all modifers and the scancodes in one single function.
    // I'm probably burning all of this to the ground after seeing how the
    // particle Tinker firmware handles DigitalWrite.
    evil.toCharArray(paramBuf, BUFFER_SIZE);
    char *pch = strtok(paramBuf, ",");
    int keyp=atoi(pch);
    pch = strtok(NULL, ",");
    long flags=atol(pch);
    Particle.publish("mods",String(flags));
    Particle.publish("char",String(keyp));
    Keyboard.click(keyp, flags);
    return 0;
}
