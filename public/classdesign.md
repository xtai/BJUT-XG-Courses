User{
	user_id,
	major_id,
	class_id,
	user_name,
	user_password,
	user_logintimes,
	user_lastlogin,
	user_lastpwdchange
}
Admin{
	user_id,
	user_name,
	user_password,
	user_logintimes,
	user_lastlogin,
	user_lastpwdchange
}
Major{
	major_id,
	major_name,
	major_enteryear,
	major_endyear
}
Subject{
	subject_id,
	subject_name,
	subject_examtype,
	subject_point,
	subject_type,
	subject_time,
	subject_school,
	major_id
}

UserDAO
MajorDAO
SubjectDAO

UserAction
MajorAction
SubjectAction

Moudle

Controller

View