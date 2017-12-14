<?php
	 
    if (!defined('BASEPATH')) exit('No direct script access allowed');
	class BGDateTime
	{
		protected $_hour; // property lưu trữ giờ
		protected $_minute; // property lưu trữ phút
		protected $_second; // property lưu trữ giây
		protected $_day; // property lưu trữ ngày
		protected $_month; //property lưu trữ tháng
		protected $_year; // property lưu trữ năm
		protected $_timestamp; // property lưu trữ timestamp
		
		/*
		* Hàm khởi tạo đối tượng DateTime
		* Truyền vào:
		* 	- Là một mảng chứa ngày tháng năm để khởi tạo timestamp
		*	- Là một số timestamp
		*	- Nếu là rỗng thì sẽ mặc định lấy timestamp hiện tại của hệ thống
		*/
		
		public function __construct($date=null)
		{
			if(is_array($date))
			{
				if(!empty($date['hour']))
				{
					$this->_setHour($date['hour']);
				}
				if(!empty($date['minute']))
				{
					$this->_setMinute($date['minute']);
				}
				if(!empty($date['second']))
				{
					$this->_setSecond($date['second']);
				}
				if(!empty($date['day']))
				{
					$this->_setDay($date['day']);
				}
				if(!empty($date['month']))
				{
					$this->_setMonth($date['month']);
				}
				if(!empty($date['year']))
				{
					$this->_setYear($date['year']);
				}
				$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			}
			else
			{
				if(is_numeric($date))
				{
					$timeStamp=$date;
				}
				else
				{
					if(empty($date) || $date==null)
					{
						$timeStamp=time();
					}
				}
			}
			$this->_setTimeStamp($timeStamp);
		}
		
		public function _setHour($hour) // Phương thức thiết lập lại giờ
		{
			$this->_hour = $hour;
			$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			$this->_setTimeStamp($timeStamp);
		}
		public function _getHour() // Phương thức lấy giờ
		{
			if(empty($this->_hour))
			{
				$hour=date('H',$this->_getTimeStamp());
				$this->_setHour($hour);
			}
			return $this->_hour;
		}
		
		public function _setMinute($minute) // Phương thức thiết lập phút
		{
			$this->_minute=$minute;
			$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			$this->_setTimeStamp($timeStamp);
		}
		public function _getMinute() // Phương thức lấy giờ
		{
			if(empty($this->_minute))
			{
				$minute=date('i',$this->_getTimeStamp());
				$this->_setMinute($minute);
			}
			return $this->_minute;
		}
		
		public function _setSecond($second) // Phương thức thiết lập giây
		{
			$this->_second=$second;
			$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			$this->_setTimeStamp($timeStamp);
		}
		public function _getSecond() // Phương thức lấy giây
		{
			if(empty($this->_second))
			{
				$second=date('s',$this->_getTimeStamp());
				$this->_setSecond($second);
			}
			return $this->_second;
		}
		
		public function _setDay($day) // Phương thức thiết lập ngày
		{
			$this->_day=$day;
			$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			$this->_setTimeStamp($timeStamp);
		}
		public function _getDay() // Phương thức lấy ngày
		{
			if(empty($this->_day))
			{
				$day=date('d',$this->_getTimeStamp());
				$this->_setDay($day);
			}
			return $this->_day;
		}
		
		public function _setMonth($month) // Phương thức thiết lập tháng
		{
			$this->_month=$month;
			$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			$this->_setTimeStamp($timeStamp);
		}
		public function _getMonth() // Phương thức lấy tháng
		{
			if(empty($this->_month))
			{
				$month=date('m',$this->_getTimeStamp());
				$this->_setMonth($month);
			}
			return $this->_month;
		}
		
		public function _setYear($year) // Phương thức thiết lập năm
		{
			$this->_year=$year;
			$timeStamp=mktime($this->_getHour(),$this->_getMinute(),$this->_getSecond(),$this->_getMonth(),$this->_getDay(),$this->_getYear());
			$this->_setTimeStamp($timeStamp);
		}
		public function _getYear() // Phương thức lấy năm
		{
			if(empty($this->_year))
			{
				$year=date('Y',$this->_getTimeStamp());
				$this->_setYear($year);
			}
			return $this->_year;
		}
		
		public function _setTimeStamp($timeStamp) // Phương thức thiết lập timestamp
		{
			$this->_timestamp=$timeStamp;
		}
		public function _getTimeStamp() // Phương thức lấy timestamp
		{
			return $this->_timestamp;
		}
		
		public function _getListMonth($curMonth=0) // Phương thức tạo ra 1 dropdown lựa chọn tháng
		{
			$html='<select name="list-month" class="list-month">';
			for($i=1;$i<=12;$i++)
			{
				$selected=($curMonth==$i)?'selected="selected"':'';
				$html.='<option value="'.$i.'" '.$selected.'>Tháng '.$i.'</option>';
			}
			$html.='</select>';
			return $html;
		}
		public function _getListYear($curYear=0, $yearSize=6) // Phương thức tạo ra 1 dropdown lựa chọn năm
		{
			// Tính cận trên và cận dưới
			$mod=$yearSize%2;
			if($mod != 0)
			{
				$asymA=(int)date('Y')-($yearSize/2);
				$asymB=(int)date('Y')+($yearSize/2)+1;
			}
			else
			{
				$asymA = (int)date('Y')-($yearSize/2);
				$asymB = (int)date('Y')+($yearSize/2);
			}
			// Xuất dropdown
			$html='<select name="list-year" class="list-year">';
			for($i=$asymA;$i<=$asymB;$i++)
			{
				$selected=($curYear==$i)?'selected="selected"':'';
				$html.='<option value="'.$i.'" '.$selected.'>Năm '.$i.'</option>';
			}
			$html.='</select>';
			return $html;
		}
		/*
		*	Hàm kiểm tra năm nhuần
		*	Năm nhuận là năm chia hết cho 400 hoặc là chia hết cho 4 nhưng không chia hết cho 100
		*/
		public function _isLeapYear($year) 
		{
			$ret = (($year%400 == 0) || ($year%4 == 0 && $year%100 != 0)) ? true : false;
			return $ret;
		}
		/*
		*	Hàm lấy tổng số ngày của tháng
		*/
		public function _getNumberDayOfMonth($month=null,$year=null)
		{
			if($month!=null && !empty($month))
			{
				$month=(int)$month;
			}
			else
			{
				$month=(int)$this->_getMonth();
			}
			if($year!=null && !empty($year))
			{
				$year=$year;
			}
			else
			{
				$year=$this->_getYear();
			}
			if($this->_isLeapYear($year))
				$array=array('','31','29','31','30','31','30','31','31','30','31','30','31');
			else
				$array=array('','31','28','31','30','31','30','31','31','30','31','30','31');
			return $array[$month];
		}
		/*
		*	Hàm lấy số thứ tự của thứ đầu tiên của tháng
		*/
		public function _getFirstDayOfMonth($month=null,$year=null)
		{
			if($month!=null && !empty($month))
			{
				$month=$month;
			}
			else
			{
				$month=$this->_getMonth();
			}
			if($year!=null && !empty($year))
			{
				$year=$year;
			}
			else
			{
				$year=$this->_getYear();
			}
			$timestamp=mktime(0,0,0,$month,1,$year);
			$array=array('Monday'=>0,'Tuesday'=>1,'Wednesday'=>2,'Thursday'=>3,'Friday'=>4,'Saturday'=>5,'Sunday'=>6);
			$index=date('l',$timestamp);
			return $array[$index];
		}
	}