- Chỉnh nút export trong phần student lại gần với add new
- Thanh scroll bị tràn màng hình
- Sửa regex tiếng việt

hello Huy

SELECT topics.* 
FROM topics LEFT JOIN topic_students on topics.topic_id = topic_students.topic_id 
GROUP BY topics.topic_id
HAVING COUNT(topic_students.user_id) < topics.max_members
