
SELECT topics.* 
FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id 
GROUP BY topics.topic_id
HAVING COUNT(topic_students.user_id) < topics.max_members

-tab giáo viên xuất file chưa có dữ liệu
-giáo viên chưa nhập điểm được