##arm7emu
Emulate ARMV7

### usage
docker build . -t armtest1
docker run --platform linux/arm/v7 --rm -ti -v $(pwd):/pwd /bin/bash armtest1
# binary build in `/test-binary`
