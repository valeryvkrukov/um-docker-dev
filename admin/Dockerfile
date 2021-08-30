FROM node:lts-alpine

WORKDIR /um-admin

COPY package.json yarn.lock ./

RUN yarn install --frozen-lockfile

COPY . .

RUN yarn build

ENV PORT=3001
ENV NODE_ENV development
ENV NEXT_TELEMETRY_DISABLED 1

COPY . .

EXPOSE 3001

CMD ["yarn", "start"]
