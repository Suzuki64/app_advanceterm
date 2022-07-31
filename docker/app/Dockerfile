# どんなdockerイメージを利用して構築をするか
FROM php:7.4-apache

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

# Composerのインストール
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# ミドルウェアインストール
RUN apt-get update \
  && apt-get install -y \
  git \
  zip \
  unzip \
  vim \
  libpq-dev \
  libonig-dev \
  libfreetype6-dev \ 
  libjpeg62-turbo-dev \
  libpng-dev \
  && docker-php-ext-install \ 
  pdo_mysql \ 
  bcmath \
  gd \
  && docker-php-ext-configure gd \
  --with-freetype=/usr/include/ \
  --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

# breeze用Nodejs
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

# Laravelで必要になるmodRewriteを有効化する
RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite