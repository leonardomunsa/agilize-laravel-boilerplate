classDiagram
direction BT
class exam {
   subject_id  /* (DC2Type:uuid) */ uuid
   student_id  /* (DC2Type:uuid) */ uuid
   integer questions_amount
   varchar(24) status
   timestamp(0) start_time
   timestamp(0) end_time
   double precision grade
}
class option {
   question_id  /* (DC2Type:uuid) */ uuid
   varchar(255) content
   boolean correct
}
class option_register {
   question_register_id  /* (DC2Type:uuid) */ uuid
   boolean correct
   boolean picked
}
class question {
   subject_id  /* (DC2Type:uuid) */ uuid
   varchar(255) content
}
class question_register {
   exam_id  /* (DC2Type:uuid) */ uuid
   varchar(255) content
}
class student {
   varchar(246) name
}
class subject {
   varchar(246) name
}

exam  -->  student : student_id:id
exam  -->  subject : subject_id:id
option  -->  question : question_id:id
option_register  -->  question_register : question_register_id:id
question  -->  subject : subject_id:id
question_register  -->  exam : exam_id:id
