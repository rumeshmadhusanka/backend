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
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (3, 1, 'full body clean hguidgsu', 1000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (4, 1, 'body paint', 3000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (5, 1, 'full tint', 32000, 'FALSE');
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
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (20, 31, 'gear box repair', 5000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (21, 1, 'replace silencer', 4000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (22, 1, 'Engine tuning', 5000, 'TRUE');
INSERT INTO service_me.service (service_id, s_id, service_name, cost, availability) VALUES (23, 1, 'ftye', 3434, 'TRUE');
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

INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 1, 1, 1, 'who needs a description?', 3.3434, 3.676, 'PENDING', '2019-05-04 10:40:02', '2019-05-15 22:51:31');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 2, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 1, 3, 3, 'this is the description', 3.789798, 6.37664867, 'DONE', '2019-05-04 10:40:02', '2019-05-15 21:36:00');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (3, 1, 4, 5, 'this is the description', 5.6589695, 6.5784, 'DONE', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 8, 8, 'description', 3.3434, 3.676, 'DONE', '2019-05-04 21:34:34', '2019-05-14 10:59:44');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (3, 28, 9, 8, 'description', 3.3434, 3.676, 'DONE', '2019-05-04 21:34:39', '2019-05-14 10:59:40');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 10, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 21:36:47', '2019-05-04 21:36:47');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 1, 11, 1, 'replace all', 50.3564, -5.6788, 'PENDING', '2019-05-11 19:55:40', '2019-05-11 19:55:40');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 25, 12, 10, 'fdvbfgb', 50.3564, -5.6788, 'DONE', '2019-05-11 19:57:43', '2019-05-14 10:59:52');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 30, 13, 18, 'uyfguyfgyigyi', 50.3564, -5.6788, 'PENDING', '2019-05-11 19:59:21', '2019-05-11 19:59:21');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 28, 14, 8, 'fgbhtbhtb', 50.3564, -5.6788, 'PENDING', '2019-05-11 20:32:51', '2019-05-11 20:32:51');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 30, 15, 18, 'gbtbhgb', 50.3564, -5.6788, 'PENDING', '2019-05-11 20:33:26', '2019-05-11 20:33:26');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 25, 16, 11, '', 50.3564, -5.6788, 'PENDING', '2019-05-13 13:09:28', '2019-05-13 13:09:28');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 17, 8, 'description', 3.3434, 3.676, 'PENDING', '2019-05-04 21:36:47', '2019-05-04 21:36:47');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (3, 28, 18, 8, 'description', 3.3434, 3.676, 'DONE', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 25, 19, 11, 'hfmnygmg', 50.3564, -5.6788, 'DONE', '2019-05-13 13:09:28', '2019-05-13 13:09:28');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (4, 1, 20, 1, 'replace all', 50.3564, -5.6788, 'PENDING', '2019-05-08 19:55:40', '2019-05-11 19:55:40');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (2, 1, 21, 3, 'this is the description', 3.789798, 6.37664867, 'DONE', '2019-05-06 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (5, 1, 22, 3, 'this is the description', 3.789798, 6.37664867, 'DONE', '2019-05-12 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 23, 8, 'description', 3.3434, 3.676, 'CANCELLED', '2019-05-04 10:40:02', '2019-05-04 12:13:36');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (4, 28, 24, 8, 'fgbhtbhtb', 50.3564, -5.6788, 'CANCELLED', '2019-05-08 20:32:51', '2019-05-11 20:32:51');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 25, 8, 'description', 3.3434, 3.676, 'DONE', '2019-05-12 21:36:47', '2019-05-04 21:36:47');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (5, 1, 26, 20, 'vyuvuy', 3.3434, 3.676, 'PENDING', '2019-05-06 00:00:00', '2019-05-15 21:31:51');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 32, 27, 19, 'clean my body', 50.3564, -5.6788, 'PENDING', '2019-05-17 10:51:34', '2019-05-17 10:51:34');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 30, 28, 7, 'clean my body', 50.3564, -5.6788, 'PENDING', '2019-05-17 10:53:57', '2019-05-17 10:53:57');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 32, 29, 19, 'clean my body', 50.3564, -5.6788, 'PENDING', '2019-05-17 10:54:06', '2019-05-17 10:54:06');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 25, 30, 10, 'hey ', 50.3564, -5.6788, 'PENDING', '2019-05-17 10:54:21', '2019-05-17 10:54:21');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 30, 31, 18, 'hey ', 50.3564, -5.6788, 'PENDING', '2019-05-17 10:54:32', '2019-05-17 10:54:32');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 28, 32, 8, 'fyreui', 50.3564, -5.6788, 'PENDING', '2019-05-21 11:19:52', '2019-05-21 11:19:52');
INSERT INTO service_me.service_request (u_id, s_id, r_id, service_id, r_description, r_latitude, r_longitude, r_status, r_submit_time, r_update_time) VALUES (1, 1, 33, 3, 'reuhvbuyfgui', 50.3564, -5.6788, 'PENDING', '2019-05-21 11:21:56', '2019-05-21 11:21:56');
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

INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (1, 'super service', 'superservice@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Wellawatta', '764563908', 51.507351, -0.127758, '../uploads/uploaded-5cd986e3ba589.png');
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (25, 'clean wash', 'cleanwash@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Nugegoda', '764653245', 54.8758, 45.4774, null);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (28, 'exterminators', 'exterminators@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Kalutara', '765634988', 51.507357, -0.127756, null);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (30, 'abc', 'services@abc.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Nugegoda', '764563908', 0, 0, '');
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_telephone, s_latitude, s_longitude, s_picture) VALUES (31, 'Panadura service station', 'pservices@yahoo.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'Panadura', '0785635897', 45.3434, 0.47394, '../uploads/uploaded-5cd99b5956e27.png');
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

INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (1, 'arya', 767261089, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'arya@gmail.com', '../uploads/uploaded-5cdda0a7431e7.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (2, 'daenariys', 764753786, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'd@gmail.com', '../uploads/uploaded-5cd8fd05ae59f.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (3, 'jhon', 578853478, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'jhon@gmail.com', '../uploads/uploaded-5cd8fc6787e4a.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (4, 'sansa', 767261089, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'sansa@gmail.com', '../uploads/uploaded-5cd8fcb3965a4.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (5, 'bu', 875678657, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'adf@gmail.com', null);
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