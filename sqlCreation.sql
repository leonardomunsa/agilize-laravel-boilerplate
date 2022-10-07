create table student
(
    id   uuid         not null
        primary key,
    name varchar(246) not null
);

comment on column student.id is '(DC2Type:uuid)';

alter table student
    owner to root;

create table subject
(
    id   uuid         not null
        primary key,
    name varchar(246) not null
);

comment on column subject.id is '(DC2Type:uuid)';

alter table subject
    owner to root;

create table exam
(
    id               uuid         not null
        primary key,
    subject_id       uuid
        constraint fk_38bba6c623edc87
            references subject,
    student_id       uuid
        constraint fk_38bba6c6cb944f1a
            references student,
    questions_amount integer      not null,
    status           varchar(24)  not null,
    start_time       timestamp(0) not null,
    end_time         timestamp(0) default NULL::timestamp without time zone,
    grade            double precision
);

comment on column exam.id is '(DC2Type:uuid)';

comment on column exam.subject_id is '(DC2Type:uuid)';

comment on column exam.student_id is '(DC2Type:uuid)';

alter table exam
    owner to root;

create table question_register
(
    id      uuid         not null
        primary key,
    exam_id uuid
        constraint fk_3cf1f018578d5e91
            references exam,
    content varchar(255) not null
);

comment on column question_register.id is '(DC2Type:uuid)';

comment on column question_register.exam_id is '(DC2Type:uuid)';

alter table question_register
    owner to root;

create index idx_3cf1f018578d5e91
    on question_register (exam_id);

create index idx_38bba6c623edc87
    on exam (subject_id);

create index idx_38bba6c6cb944f1a
    on exam (student_id);

create table option_register
(
    id                   uuid         not null,
    content              varchar(255) not null,
    question_register_id uuid
        constraint fk_7f8e31b0aa7214f3
            references question_register,
    correct              boolean      not null,
    picked               boolean      not null,
    primary key (id, content)
);

comment on column option_register.id is '(DC2Type:uuid)';

comment on column option_register.question_register_id is '(DC2Type:uuid)';

alter table option_register
    owner to root;

create unique index uniq_7f8e31b0bf396750
    on option_register (id);

create index idx_7f8e31b0aa7214f3
    on option_register (question_register_id);

create table question
(
    id         uuid         not null
        primary key,
    subject_id uuid
        constraint fk_b6f7494e23edc87
            references subject,
    content    varchar(255) not null
);

comment on column question.id is '(DC2Type:uuid)';

comment on column question.subject_id is '(DC2Type:uuid)';

alter table question
    owner to root;

create table option
(
    id          uuid         not null
        primary key,
    question_id uuid
        constraint fk_5a8600b01e27f6bf
            references question,
    content     varchar(255) not null,
    correct     boolean      not null
);

comment on column option.id is '(DC2Type:uuid)';

comment on column option.question_id is '(DC2Type:uuid)';

alter table option
    owner to root;

create index idx_5a8600b01e27f6bf
    on option (question_id);

create index idx_b6f7494e23edc87
    on question (subject_id);

