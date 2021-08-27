FROM node:lts as admin_dependencies
WORKDIR /um-admin
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

FROM node:lts as admin_builder
WORKDIR /um-admin
COPY . .
COPY --from=admin_dependencies /um-admin/node_modules ./node_modules
RUN yarn build

FROM node:lts as admin_runner
ENV PORT=3001
WORKDIR /um-admin
ENV NODE_ENV development
ENV NEXT_TELEMETRY_DISABLED 1
COPY --from=admin_builder /um-admin/public ./public
COPY --from=admin_builder /um-admin/.next ./.next
COPY --from=admin_builder /um-admin/node_modules ./node_modules
COPY --from=admin_builder /um-admin/package.json ./package.json
EXPOSE 3001
CMD ["yarn", "start"]
