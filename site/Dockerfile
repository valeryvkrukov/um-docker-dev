FROM node:lts-alpine

WORKDIR /um-site

COPY package.json yarn.lock ./

RUN yarn install --frozen-lockfile

COPY . .

RUN yarn build

ENV PORT=3000
ENV NODE_ENV development
ENV NEXT_TELEMETRY_DISABLED 1

COPY . .

EXPOSE 3000

CMD ["yarn", "start"]
