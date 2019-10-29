<?php
	$host = "localhost";
	$username= "root";
	$dbname = "e-news-system";
	$password = "";
	$error_log = "errors.txt";
	//$uid = $_SESSION['id'];
	
	$db = @mysql_connect($host, $username, $password) or process_error ("Could not connect to database server");
		
	@mysql_select_db($dbname) or process_error (mysql_error());
	
	function process_error($s)	{
	    if (is_writeable($error_log)) {
	        $s = "\r\n" . date('Y-m-d H:i:s') . ' ' . $s;
	        $fd = fopen($error_log, 'a+');
	        $fout = fwrite($fd, $s);
	        fclose($fd);
	    }
		
		die("<font color='red'>SQL error... Please check your error log file for details...</font>". $s . mysql_error());
	}
	
	function preload($content) {
		// Strip newline characters.
		$content = str_replace(chr(10), " ", $content);
		$content = str_replace(chr(13), " ", $content);
		// Replace single quotes.
		$content = str_replace(chr(145), chr(39), $content);
		$content = str_replace(chr(146), chr(39), $content);
		// Return the result.
		return $content;
	}
	
	function db_que($query)	{
		$result = mysql_query($query);
		if (!$result)
		{
			//unable to execute query
			//send notification email
			//die (mysql_error());
		}
		else
		{
			return $result;
		}
	}
	
	function get_obj($result)	{
		return mysql_fetch_object($result);
	}
	
	function rows($obj)	{
		return mysql_num_rows($obj);
	}
	
	function db_esc($value)	{
	    //Stripslashes
	    if (get_magic_quotes_gpc())
		{
	        $value = stripslashes($value);
	    }
	    //Quote if not integer
	    if (!is_numeric($value)) {
			$value = trim($value);
	        $value = @mysql_real_escape_string($value);
	    }
	    return $value;
	}
	
	function validate_user ($uname, $pwd)	{
		//check if user exists
		$query = "select * from users where username = '$uname' and password = '$pwd'";
		return db_que($query);
	}
	
	function update_login($id)	{
		//last login == now + currnt ipaddress
		$query = "update users set lastlogin = NOW() where id = '$id'";
		$result = db_que($query);
		
		//no of visits
		$query = "select no_of_visits as nov from users where id = '$id'";
		$result = db_que($query);
		$ob = get_obj($result);
		$nov = $ob->nov + 1;
		
		$query = "update users set no_of_visits = '$nov' where id = '$id'";
		db_que($query);
	}
	
	function get_lastlogin($id)	{
		$query = "select lastlogin from users where id = '$id'";
		$result = db_que($query);
		$sts = get_obj($result);
		
		return $sts->lastlogin;
	}
	
	function get_cats()	{
		$query = "select * from categories where status = 1";
		return db_que($query);
	}
	
	function get_cats_ad()	{
		$query = "select * from categories";
		return db_que($query);
	}
	
	function delbook($bid)	{
		$query = "delete from books where id = '$bid'";
		db_que($query);
	}
	
	function num_books($id)	{
		$query = "select count(id) as ci from books where cid = '$id'";
		return get_obj(db_que($query))->ci;
	}
	
	function get_books($id)	{
		$query = "select * from books where cid = '$id'";
		return db_que($query);
	}
	
	function books()	{
		$query = "select * from books";
		return db_que($query);
	}
	
	function get_book($bid)	{
		$query = "select * from books where id = '$bid'";
		return db_que($query);
	}
	
		function get_news_details($nid)	{
		$query = "select * from news where id = '$nid'";
		return db_que($query);
	}
	
	function get_news_default()	{
		$query = "select * from news where id = '1'";
		return db_que($query);
	}
	function get_download($bid)	{
		$query = "select file from books where id = '$bid'";
		
		if((db_que($query)) != "")
		{
			return db_que($query);
		}
		else
		{
			return "<font color='red'>File not uploaded for this book.</font>";
		}
	}
	
	function update_views($bid)	{
		$query = "select views from books where id = '$bid'";
		$no = get_obj(db_que($query))->views;
		$no = $no + 1;
		$query = "update books set views = '$no' where id = '$bid'";
		db_que($query);
	}
	
	function do_search($terms, $no)	{
		$fterm = $terms[0];	$sterm = $terms[1];	$tterm = $terms[2];	$lterm = $terms[3];
		
		if ($no == 1)
		{
			$query = "select * from books where (title like '%$fterm%' or author like '%$fterm%')";
		}
		else if ($no == 2)
		{
			$query = "select * from books where (title like '%$fterm%' or author like '%$fterm%' or title like '%$sterm%' or author like '%$sterm%')";
		}
		else if ($no == 3)
		{
			$query = "select * from books where (title like '%$tterm%' or author like '%$tterm%' or title like '%$fterm%' or author like '%$fterm%' or title like '%$sterm%' or author like '%$sterm%')";
		}
		else
		{
			$query = "select * from books where (title like '%$tterm%' or author like '%$tterm%' or title like '%$fterm%' or author like '%$fterm%' or title like '%$sterm%' or author like '%$sterm%' or title like '%$lterm%' or author like '%$lterm%')";
		}
		
		return db_que($query);
	}
	
	function get_cat($cid)	{
		$query = "select * from categories where id = '$cid'";
		return db_que($query);
	}
	
	function get_news_update($cid)	{
		$query = "select * from news where id = '$cid'";
		return db_que($query);
	}
	
	function update_news($uid, $title, $desc, $details, $newname)	{
		$query = "update news set title = '$title', desc = '$desc', details = '$details', news_image = '$newname' where id = '$uid'";
		if (db_que($query))
		{
			return "<font color='blue'>Update successful.</font>";
		}
		else
		{
			return "<font color='red'>Unable to update news, please try again later.</font>";
		}		
	}
	
	function update_cat($cid, $cat)	{
		$query = "update categories set category = '$cat' where id = '$cid'";
		if (db_que($query))
		{
			return "<font color='blue'>Update successful.</font>";
		}
		else
		{
			return "<font color='red'>Unable to update category name, please try again later.</font>";
		}		
	}
	
	function addissue($comment)
	{
		$std = $_SESSION['id'];
		$user = $_SESSION['username'];
		$query = "insert into forum_log values (NULL, '$user', '$comment', '$std', NOW())";
		if (db_que($query))
		{
			return "<font color='blue'>Comment added succesfully.</font>";
		}
		else
		{
			return "<font color='red'>Unable to add comment, please try again later.</font>";
		}
	}
	
	function add_comment($comment, $id)
	{
		$user = $_SESSION['username'];
		if(!empty($id))
		{
			$query = "insert into forum_comment values (NULL, '$user', '$comment', '$id', NOW())";
			if (db_que($query))
			{
				return "<font color='blue'>Comment added succesfully.</font>";
			}
			else
			{
				return "<font color='red'>Unable to add comment, please try again later.</font>";
			}
		}
	}
	
	function num_comment($id)	{
		$query = "select count(id) as ci from forum_comment where forum_log_id = '$id'";
		if(get_obj(db_que($query))->ci > 0)
		{
			return get_obj(db_que($query))->ci;
		}
	}
	
	function get_num_comment($nid)	{
		$query = "select * from forum_comment where forum_log_id = '$nid'";
		return db_que($query);
	}
	
	function last_comment($id)	{
		$query = "select Id from forum_log where Id = '$id'";
		$res = db_que($query);
		$st = get_obj($res);
		
		if ($st->Id)
		{
			$que = "select comment from forum_comment where forum_log_id = '$id' ORDER BY id DESC LIMIT 0,1";
			$res1 = db_que($que);
			$nam = get_obj($res1);
			if(!empty($nam))
			{			
				return $nam->comment . ' ' . 'By ' ;
			}
		}
		
	}
	
	function last_user($id)	{
		$query = "select Id from forum_log where Id = '$id'";
		$res = db_que($query);
		$st = get_obj($res);
		
		if ($st->Id)
		{
			$que = "select user from forum_comment where forum_log_id = '$id' ORDER BY id DESC LIMIT 0,1";
			$res1 = db_que($que);
			$nam = get_obj($res1);
			
			return $nam->user;
		}
	}
	
	function get_forum_comment()	
	{
		$query = "select * from forum_log order by id desc";
		
		return db_que($query);
	}
	
	function create_cat($cat)	{
		$query = "insert into categories values (NULL, '$cat', '1')";
		if (db_que($query))
		{
			return "<font color='blue'>Category created.</font>";
		}
		else
		{
			return "<font color='red'>Unable to create category, please try again later.</font>";
		}
	}
	
	function update_book($bid, $title, $author, $published, $content, $newname)	{
		$query = "update books set title = '$title', author = '$author', published = '$published', content = '$content', file = '$newname' where id = '$bid'";
		if (db_que($query))
		{
			return "<font color='blue'>Update successful.</font>";
		}
		else
		{
			return "<font color='red'>Unable to update book information, please try again later.</font>";
		}
	}
	
	function deact($cid)	{
		$query = "update categories set status = '0' where id = '$cid'";
		db_que($query);
	}
	
	function act($cid)	{
		$query = "update categories set status = '1' where id = '$cid'";
		db_que($query);
	}
	
	function create_book($cid, $title, $author, $published, $content, $newname)	{
		$query = "insert books values (NULL, '$cid', '$title', '$author', '$published', '$content', '$newname', NOW(), '0', '0')";
		if (db_que($query))
		{
			return "<font color='blue'>Book has been added successfully.</font>";
		}
		else
		{
			return "<font color='red'>Unable to add book, please try again later.</font>";
		}
	}
	
	function change_pwd($opwd, $npwd)	{
		$uid = $_SESSION['id'];
		$query = "select password from users where id = '$uid'";
		if (get_obj(db_que($query))->password == $opwd)
		{
			$query = "update users set password = '$npwd' where id = '$uid'";
			if (db_que($query))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return false;
	}
	
	function get_users()	{
		$query = "select * from users where role <> 'admin'";
		return db_que($query);
		}
	

	function get_news()	
	{
		$query = "select * from news";
		return db_que($query);
	}
	
	function get_news_page()	
	{
		$query = "select * from news where status = 1";
		return db_que($query);
	}
	
	function get_comment_page($nid)	
	{
		$query = "select * from forum_comment where forum_log_id = '$nid' ORDER BY id ASC LIMIT 0,1";
		return db_que($query);
	}
	
	function get_comment_page_id($nid)	
	{
		$query = "select * from forum_comment where id = '$nid'";
		return db_que($query);
	}
	
	function resetp ($id)	{
		$query = "select username from users where id = '$id'";
		$un = get_obj(db_que($query))->username;
		$newpass = substr(md5(strtotime(now).$un), 0, 8);
		$pass = md5($newpass);
		$validtill = date('Y-m-d', strtotime("+30 days"));
		$que = "update users set password = '$pass', validtill = '$validtill' where id = '$id'";
		if (db_que($que))
		{
			return "<font color='blue'>Password reset completed. New password for <b>$un</b> is <b>$newpass</b></font>";
		}
		else
		{
			return "<font color='red'>Unable to reset password.</font>";
		}
	}
	
	function delete_user ($id)	{
		$query = "delete from users where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>User has been deleted from the database.</font>";
		}
		else
		{
			return "<font color='red'>Unable to delete user.</font>";
		}
	}
	
	function delete_news ($id)	{
		$query = "delete from news where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>News has been deleted from the database.</font>";
		}
		else
		{
			return "<font color='red'>Unable to delete news.</font>";
		}
	}
	
	function disable ($id)	{
		$validtill = date('Y-m-d', strtotime("-2 days"));
		$query = "update users set validtill = '$validtill', status = '0' where id = '$id'";
		if (db_que($query))
		{
			return "<font colorblue'>User has been disabled.</font>";
		}
		else
		{
			return "<font color='red'>Unable to disable new user.</font>";
		}
	}
	
	function disable_news ($id)	{
		$query = "update news set status = '0' where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>News has been disabled.</font>";
		}
		else
		{
			return "<font color='red'>Unable to disable news.</font>";
		}
	}

	function enable ($id)	{
		$validtill = date('Y-m-d', strtotime("+7 days"));
		$query = "update users set validtill = '$validtill', status = '1' where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>User has been enabled.</font>";
		}
		else
		{
			return "<font color='red'>Unable to enable new user.</font>";
		}
	}
	
	function enable_news ($id)	{
		$query = "update news set status = '1' where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>News has been enabled.</font>";
		}
		else
		{
			return "<font color='red'>Unable to enable news.</font>";
		}
	}
	
	function create_news($title, $desc, $details, $newname)	{
		$query = "insert into news values (NULL, '$title', 'desc', '$details', '$uid', '1', '$newname',  NOW())";
		if (db_que($query))
		{
			return "<font color='blue'>News has been created successfully.</font>";
		}
		else
		{
			return "<font color='red'>Unable to create news.</font>";
		}
	}
	
	function create_user($fname, $lname, $mname, $uname, $role)	{
		$validtill = date('Y-m-d', strtotime("+30 days"));
		$newpass = substr(md5(strtotime(now).$uname), 0, 8);
		$pass = md5($newpass);
		$query = "insert into users values (NULL, '$uname', '$pass', '$role', '$validtill', '$uid', '$fname', '$mname', '$lname', '1', NOW(), NOW(), '0')";
		if (db_que($query))
		{
			return "<font color='blue'>User has been created. The password is <b> $newpass </b>.</font>";
		}
		else
		{
			return "<font color='red'>Unable to create new user.</font>";
		}
	}
	
	function get_vids()	{
		$query = "select * from videos";
		return db_que($query);
	}
	
	function get_name ($sid)	{
		$query = "select firstname, middlename, lastname from users where id = '$sid'";
		$ob = get_obj(db_que($query));
		return $ob->firstname." ".$ob->middlename." ".$ob->lastname;
	}
	
	function show_vid ($id)	{
		$query = "update videos set status = 1 where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>Video been enabled</font>";
		}
		else
		{
			return "<font color='red'>Unable to enable video.</font>";
		}
	}
	
	function hide_vid ($id)	{
		$query = "update videos set status = 0 where id = '$id'";
		if (db_que($query))
		{
			return "<font color='blue'>Video been disabled.</font>";
		}
		else
		{
			return "<font color='red'>Unable to disable video</font>";
		}
	}
	
	function del_vid ($id)	{
		$query = "delete from videos where id = '$id'";
		db_que($query);
	}
	
	function get_path ($id)	{
		$query = "select path from videos where id = '$id'";
		return get_obj(db_que($query))->path;
	}
	
	function add_video($title, $cat, $path, $id)	{
		$query = "insert into videos values (NULL, '$title', '$cat', '$id', '$path', '1', NOW())";
		if (db_que($query))
		{
			return "<font color='red'>Video has been added.</font>";
		}
		else
		{
			return "<font color='red'>Unable to add video.</font>";
		}
	}
	
	function get_videos()	{
		$query = "select * from videos where status = 1";
		return db_que($query);
	}
	
	function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i)
		{
			return ""; 
		}
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}
?>