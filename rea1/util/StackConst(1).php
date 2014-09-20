<?php
//�ر��쳣����
ini_set("error_reporting","E_ALL & ~E_NOTICE");
//����ʱ���ʽ
date_default_timezone_set('Asia/Shanghai');

class StackConst {
	
	/**
	 * @return Ymd 20131118
	 *
	 */
	static public function get_date_min(){
		//��ȡʱ��
		$dateTime = date('Ymd');
		//����ϵͳʱ��
		return $dateTime;
	}
	
	/**
	 * @return Y-m-d
	 */
	static public function get_date_sort(){
		//��ȡʱ��
		$dateTime = date('Y-m-d');
		//����ϵͳʱ��
		return $dateTime;
	}
	/**
	 * @return Y-m-dH:i:s
	 */
	static public function get_date(){
		//��ȡʱ��
		$dateTime = date('Y-m-d H:i:s');
		//����ϵͳʱ��
		return $dateTime;
	}
	
	/**
	 * @return ��ȡʱ���
	 */
	static public function get_date_str(){
		
		//��ȡʱ��
		$dateTime = date('Y-m-d H:i:s');
		
		//���ʱ�䴮
		$year=((int)substr($dateTime,0,4));//ȡ�����
		$month=((int)substr($dateTime,5,2));//ȡ���·�
		$day=((int)substr($dateTime,8,2));//ȡ�ü���
		$second = ((int)substr($dateTime,11,2));//ȡ�ü���
		$minute = ((int)substr($dateTime,14,2));//ȡ�ü���
		$hour = ((int)substr($dateTime,17,2));//ȡ�ü���
		
		//����ʱ���
		return mktime($hour,$minute,$second,$month,$day,$year);
		
	}
	
	/**
	 * @return ͼƬ·��
	 */
	static public function res_pic_url(){
		return "../picstack/";
	}
	
	/**
	 * @return �ļ�·��
	 */
	static public function res_file_url(){
		return "../filestack/";
	}
	
	/**
	 * @param ��ת $url
	 */
	static public function jump_page($url){
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	}
	
}

?>