FROM ubuntu:18.04
WORKDIR /app
COPY . /app

RUN /app/install.sh
