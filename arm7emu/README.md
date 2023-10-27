## arm7emu
Emulate ARMV7, for example build an binary using Debian x64 and run it on RPi ARM

### usage

```
docker build . -t armtest1
docker run --platform linux/arm/v7 --rm -ti -v $(pwd):/pwd armtest1 /bin/bash
```

After this, a ARM-binary is built in `/test-binary`.
