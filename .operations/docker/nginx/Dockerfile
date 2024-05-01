FROM nginx:alpine
ADD ./ssl/certs/topfeest.local.crt:/etc/ssl/certs


WORKDIR /var/www/topfeest

COPY ../../../public /var/www/topfeest

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]