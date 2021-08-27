FROM node:lts as dependencies
WORKDIR /um-site
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

FROM node:lts as builder
WORKDIR /um-site
COPY . .
COPY --from=dependencies /um-site/node_modules ./node_modules
RUN yarn build

FROM node:lts as runner
ENV PORT=3000
WORKDIR /um-site
ENV NODE_ENV development
ENV NEXT_TELEMETRY_DISABLED 1
COPY --from=builder /um-site/public ./public
COPY --from=builder /um-site/.next ./.next
COPY --from=builder /um-site/node_modules ./node_modules
COPY --from=builder /um-site/package.json ./package.json
EXPOSE 3000

CMD ["yarn", "start"]
