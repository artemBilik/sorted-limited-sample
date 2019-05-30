# sorted-limited-sample

1. Clone repository
> git clone git@github.com:artemBilik/sorted-limited-sample.git && cd sorted-limited-sample
2. Build docker container
> docker build -t test ./
3. Run container
> docker run -it test /bin/bash
4. Generate files in /app/files directory 
> cd /app && php generator.php
5. Run script
> cd /app/src && php app.php
7.  Check result
> cat /app/result.csv
