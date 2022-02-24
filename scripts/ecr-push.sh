#!/bin/bash

aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin 863788357263.dkr.ecr.us-east-2.amazonaws.com

docker build -t movie-api .

docker tag movie-api:latest 863788357263.dkr.ecr.us-east-2.amazonaws.com/movie-api:latest

docker push 863788357263.dkr.ecr.us-east-2.amazonaws.com/movie-api:latest
