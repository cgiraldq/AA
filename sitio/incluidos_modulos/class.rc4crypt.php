<?php
/*  *****************************************************************************
**
**  RC4Crypt 2.1
**
**  $Id: class.rc4crypt.php,v 2.1 2005/05/03 07:10:41 Owner Exp Owner $
**
**  2005/04/28 -- Bug fix for incorrect output due to XORing stupidity
**                [Ariel Arjona (beerfrick@users.sourceforge.net)]
**  2003/11/15 -- Cleans urlencode's, fixed the invalid outputs
**  2003/02/22 -- A fix, which turned out to be a bug!
**  2001/02/24 -- Passes RC4 Vector Harness
**
**  Website     : http://www.devhome.org
**  Email       : god@mjsabby.com
**  Description : Provides the main functionality of the program
**
**  Copyright Notice:
**
**  RC4 is a registered trademark of the RSA Data Security Inc.
**  This is an implementation of the original algorithm. The author
**  of this program is NOT the original publisher of this algorithm.
**
**  (C) Copyright 2003, 2005 Mukul Sabharwal [http://mjsabby.com]
**  All Rights Reserved
**
**  This program is free software; you can redistribute it and/or
**  modify it under the terms of the GNU General Public License
**  as published by the Free Software Foundation; either version 2
**  of the License, or (at your option) any later version.
**
**  This program is distributed in the hope that it will be useful,
**  but WITHOUT ANY WARRANTY; without even the implied warranty of
**  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
**  GNU General Public License for more details.
**
**  The GNU General Public License can be found at
**  http://www.gnu.org/copyleft/gpl.html
**
**  You should have received a copy of the GNU General Public License
**  along with this program; if not, write to the Free Software
**  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
**
**  ****************************************************************************/

class rc4crypt {

	function encrypt ($pwd, $data)
	{
		$key[] = '';
		$box[] = '';

		$pwd_length = strlen($pwd);
		$data_length = strlen($data);

		for ($i = 0; $i < 256; $i++)
		{
			$key[$i] = ord($pwd[$i % $pwd_length]);
			$box[$i] = $i;
		}

		for ($j = $i = 0; $i < 256; $i++)
		{
			$j = ($j + $box[$i] + $key[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for ($a = $j = $i = 0; $i < $data_length; $i++)
		{
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;

			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;

			$k = $box[(($box[$a] + $box[$j]) % 256)];
			$cipher .= chr(ord($data[$i]) ^ $k);

		}

		return $cipher;

	}

	function decrypt ($pwd, $data)
	{
		return $this->encrypt($pwd, $data);
	}
}

?>

