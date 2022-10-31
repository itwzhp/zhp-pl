FROM node:14.15.0-alpine as build

WORKDIR /usr/src/app
COPY /packages/app/package.json /usr/src/app/package.json
RUN yarn install --silent

COPY /packages/app /usr/src/app
RUN yarn build
RUN yarn install --prod

FROM node:14.15.0-alpine as run

WORKDIR /usr/src/app

COPY --from=build /usr/src/app/static static
COPY --from=build /usr/src/app/node_modules node_modules
COPY --from=build /usr/src/app/package.json .
COPY --from=build /usr/src/app/nuxt.config.js .
COPY --from=build /usr/src/app/.env .env
COPY --from=build /usr/src/app/.nuxt .nuxt


ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

EXPOSE 3000

CMD ["yarn", "start"]