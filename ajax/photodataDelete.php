<?php
parse_str(file_get_contents('php://input'), $data);
unlink('../' . $data['name']);
