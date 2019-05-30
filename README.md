# sorted-limited-sample

1. Clone repository
> git clone git@github.com:artemBilik/sorted-limited-sample.git
2. Build docker container
> cd sorted-limited-sample && docker build -t test ./
3. Run container
> docker run -it test /bin/bash
4. Generate files in /app/files directory 
> cd /app && php generate.php
5. Run script
> cd /app/src && php app.php
7.  Check result
> cat /app/result.csv
