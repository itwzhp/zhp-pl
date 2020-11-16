# Dockerfile
FROM node:14.15.0-alpine

# create destination directory
RUN mkdir -p /usr/src/nuxt-app
WORKDIR /usr/src/nuxt-app

#update and install dependency
RUN apk update && apk upgrade
RUN apk add git

#copy the app, note .dockerignore
COPY . /usr/src/nuxt-app/
RUN yarn
RUN yarn create-index
RUN yarn nuxt:build

ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

CMD ["yarn", "nuxt:start"]
