create table service
(
    service_id   int(30) auto_increment
        primary key,
    s_id         int(30)     not null,
    service_name varchar(50) not null,
    cost         int(20)     not null,
    constraint service_ibfk_1
        foreign key (s_id) references service_station (s_id)
);

create index s_id
    on service (s_id);

INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (1, 1, 'wheel alignment', 20000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (2, 1, 'full body wax', 5000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (3, 1, 'full body clean', 1000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (4, 1, 'body paint', 3000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (5, 1, 'full tint', 32000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (6, 25, 'full body wash', 5000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (7, 30, 'full oil restore', 3000);
INSERT INTO service_me.service (service_id, s_id, service_name, cost) VALUES (8, 28, 'full body clean', 20000);
create table service_station
(
    s_id       int(30) auto_increment
        primary key,
    s_name     varchar(100) null,
    s_email    varchar(100) not null,
    s_password varchar(500) not null,
    s_city     varchar(100) null,
    s_workers  int(20)      null,
    s_picture  blob         null,
    constraint s_email
        unique (s_email)
);

INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_workers, s_picture) VALUES (1, 'super service', 'superservice@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'colombo', 20, null);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_workers, s_picture) VALUES (25, 'abc', 'abc@gmail', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'sas', 15, 0x4172726179);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_workers, s_picture) VALUES (28, 'abc', 'abc@gmailj', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'sas', 15, 0x4172726179);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_workers, s_picture) VALUES (30, 'abc', 'abc@gmaialj', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'sas', 15, 0x4172726179);
INSERT INTO service_me.service_station (s_id, s_name, s_email, s_password, s_city, s_workers, s_picture) VALUES (31, 'abc', 'abd@dfdf', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'vfdv', 10, 0x4172726179);
create table service_station_location
(
    s_id     int(30) not null,
    latitude double  not null,
    logitude double  not null
);

INSERT INTO service_me.service_station_location (s_id, latitude, logitude) VALUES (1, 51.507351, -0.127758);
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

INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (1, 'susan', 767261089, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'susan@gmail.com', 'uploads/uploaded-5cc58f247cc6e.jpg');
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (2, 'abc', 577587, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'abc@gmail.com', null);
INSERT INTO service_me.user (u_id, u_name, u_tele, u_password, u_email, u_profile_pic) VALUES (3, 'jhon', 5436546, 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', 'jhon@gmail.com', 'uploads/uploaded-5cc690f26bebb.jpg');
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