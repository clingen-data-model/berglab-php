# PHP images for berglab projects.

These php images are suitable for use on the Openshift platform operated by Carolina Cloudapps. 

## 8.0
Based on docker.io/php:8.0-apache, this image is configured to run Laravel applications using Apache as a webserver.  They run as unprivileged users and expose unprivileged ports. So they will work with Redhat Openshift.

This all UNC owned ClinGen applications currently in production are built from this image registered at [docker hub](https://hub.docker.com/repository/docker/jward3/php)

## 8.1
Based on docker.io/php:8.1-apache, this image is configured to run Laravel applications using Apache as a webserver.  They run as unprivileged users and expose unprivileged ports. So they will work with Redhat Openshift.

It is not currently used by any UNC owned ClinGen applications.

## 8.1-fpm
Based on FROM php:8.1-fpm, this image is configured to run Laravel applications as a FPM server.  It does not include a web-server and should be deployed with a proxied to from nginx or apache web server.

This image is currently used in the prototype [Functional Assay Interface](https://fai.apps.cloudapps.unc.edu/), behind an nginx web server.