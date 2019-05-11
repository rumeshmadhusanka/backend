create table service
(
    service_id   int(30) auto_increment
        primary key,
    s_id         int(30)                                       not null,
    service_name varchar(50)                                   not null,
    cost         int(20)                                       not null,
    availability enum ('TRUE', 'FALSE', '', '') default 'TRUE' not null,
    constraint service_ibfk_1
        foreign key (s_id) references service_station (s_id)
);

create index s_id
    on service (s_id);

INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (1, 1, 'wheel alignment', 20000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (2, 1, 'full body wax', 5000, 'FALSE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (3, 1, 'full body clean', 1000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (4, 1, 'body paint', 3000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (5, 1, 'full tint', 32000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (6, 25, 'full body wash', 5000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (7, 30, 'full oil restore', 3000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (8, 28, 'full body clean', 20000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (9, 25, 'wheel alignment', 15000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (10, 25, 'full body clean', 1500, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (11, 25, 'body paint', 3500, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (12, 25, 'full tint', 31000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (17, 32, 'full body clean', 750, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (18, 30, 'wheel alignment', 25000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (19, 32, 'full body clean', 1100, 'TRUE');
create table service_request
(
    u_id          int(30)                                                             not null,
    s_id          int(30)                                                             not null,
    r_id          int(30) auto_increment
        primary key,
    service_id    int(30)                                                             null,
    r_description varchar(1000)                                                       null,
    r_latitude    double                                                              null,
    r_longitude   double                                                              null,
    r_status      enum ('PENDING', 'DONE', 'CANCELLED', '') default 'PENDING'         not null,
    r_submit_time timestamp                                 default CURRENT_TIMESTAMP not null,
    r_update_time timestamp                                 default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    constraint service_request_ibfk_1
        foreign key (s_id) references service_station (s_id),
    constraint service_request_ibfk_2
        foreign key (u_id) references user (u_id),
    constraint service_request_ibfk_3
        foreign key (service_id) references service (service_id)
);

create index s_id
    on service_request (s_id);

create index service_id
    on service_request (service_id);

create index u_id
    on service_request (u_id);

INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 1, 1, 1, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 10:40:02', '2019-05-04 13:11:58');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 2, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 1, 3, 3, 'this is the description', 3.789798, 6.37664867, 'DONE', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (3, 1, 4, 5, 'this is the description', 5.6589695, 6.5784, 'DONE', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 8, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 21:34:34', '2019-05-04 21:34:34');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (3, 28, 9, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 21:34:39', '2019-05-04 21:34:39');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 10, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 21:36:47', '2019-05-04 21:36:47');
create table service_station
(
    s_id        int(30) auto_increment
        primary key,
    s_name      varchar(100) null,
    s_email     varchar(100) not null,
    s_password  varchar(500) not null,
    s_city      varchar(100) null,
    s_telephone text         null,
    s_latitude  double       not null,
    s_longitude double       not null,
    s_picture   varchar(500) null,
    constraint s_email
        unique (s_email)
);

INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (1, 'super service', 'superservice@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Wellawatta', '764563908', 51.507351, -0.127758, 'uploads/uploaded-5476567c4a63.jpg');
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (25, 'clean wash', 'cleanwash@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Nugegoda', null, 54.8758, 45.4774, null);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (28, 'exterminators', 'exterminators@gmail.com', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'Kalutara', '765634988', 51.507357, -0.127756, null);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (30, 'abc', 'services@abc.com', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'Nugegoda', null, 0, 0, '');
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (31, 'Panadura service satation', 'pservices@yahoo.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Panadura', null, 0, 0, null);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (32, 'ultraService', 'ultra@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Moratuwa', '0785426976', 5435435, 4354354, null);
create table user
(
    u_id          int(30) auto_increment
        primary key,
    u_name        varchar(100)  null,
    u_tele        int(10)       null,
    u_password    varchar(1000) not null,
    u_email       varchar(100)  not null,
    u_profile_pic text          null,
    constraint u_email
        unique (u_email)
);

INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (1, 'susan', 767261089, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'susan@gmail.com', '../uploads/uploaded-5cd418b6e870b.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (2, 'PQR', 577587, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'pqr@gmail.com', '../uploads/uploaded-5cc690f26bebb.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (3, 'jhon', 5436546, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'jhon@gmail.com', '../uploads/uploaded-5cc690f26bebb.jpg');
create table user_location
(
    u_id      int(30)                             not null,
    latitude  double                              not null,
    longitude double                              not null,
    timestamp timestamp default CURRENT_TIMESTAMP not null,
    constraint user_location_ibfk_1
        foreign key (u_id) references user (u_id)
);

create index u_id
    on user_location (u_id);

INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-02 11:41:47');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-02 12:07:13');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-02 12:09:32');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-02 12:10:12');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-02 12:11:41');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-02 13:03:27');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-04 15:05:52');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-04 21:42:24');
INSERT INTO service_me.user_location (u_id, latitude, longitude, timestamp) VALUES (1, 51.507351, -0.127758, '2019-05-04 21:44:58');