<?php
class Api
{
	protected $_steveBase64 = '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';
	public function getUuidFromName($name)
	{
		$ch = curl_init('https://api.mojang.com/users/profiles/minecraft/'.urlencode($name));
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$return = @curl_exec($ch);
		$data = json_decode($return);
		if (!$data)
		{
			return false;
		}
		return $data->id;
	}

	public function getNameHistoryFromUuid($uuid)
	{
		$ch = curl_init('https://api.mojang.com/user/profiles/'.urlencode($uuid).'/names');
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$return = @curl_exec($ch);
		$data = json_decode($return);
		if (!$data)
		{
			return false;
		}
		return $data;
	}

	public function getCurrentUsernameFromUuid($uuid)
	{
		$data = $this->getNameHistoryFromUuid($uuid);
		if (!$data)
		{
			return false;
		}
		$data = end($data);
		return $data->name;
	}

	function getSkinBase64($uuid)
	{
		$ch = curl_init('https://sessionserver.mojang.com/session/minecraft/profile/'.urlencode($uuid));
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		@curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$return = @curl_exec($ch);

		$data = json_decode($return);
		if (!$data)
		{
			return $this->_steveBase64;
		}
		if (property_exists($data, 'errorMessage'))
		{
			return $this->_steveBase64;
		}
		$textures = null;
		foreach ($data->properties as $property)
		{
			if ($property->name == 'textures')
			{
				$textures = $property->value;
				break;
			}
		}
		if (!$textures)
		{
			return $this->_steveBase64;
		}

		$textures = json_decode(base64_decode($textures));
		if (!$textures) return $this->_steveBase64;
		if (!property_exists($textures, 'textures')) return $this->_steveBase64;
		if (!property_exists($textures->textures, 'SKIN'))
		{
			return $this->_steveBase64;
		}
		if (!property_exists($textures->textures->SKIN, 'url'))
		{
			return $this->_steveBase64;
		}
		$skinUrl = $textures->textures->SKIN->url;
		$ch = curl_init($skinUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$skin = curl_exec($ch);

		return base64_encode($skin);
	}

	public function getSkin($name)
	{
		$type = 'username';
		$username = $name;
		$uuid = '';
		if (strlen($name) > 16)
		{
			$type = 'uuid';
			$username = '';
			$uuid = $name;
		}

		$cacheFile = './internal_data/skins/'.strtolower($name).'.json';
		if (!file_exists($cacheFile))
		{
			$skinBase64 = $this->rebuildSkinCache($name, $username, $uuid);
		}
		else
		{
			$cache = file_get_contents($cacheFile);
			$data = json_decode($cache);

			// Recache every day
			if ($data->last_cache < time() - 86400)
			{
				$skinBase64 = $this->rebuildSkinCache($name, $username, $data->uuid);
			}
			else
			{
				$skinBase64 = $data->skin;
			}
		}

		return $skinBase64;
	}

	public function rebuildSkinCache($name, $username='', $uuid='')
	{
		$cacheFile = './internal_data/skins/'.strtolower($name).'.json';
		if (!empty($username))
		{
			$uuid = $this->getUuidFromName($username);
			$username = $username;
		}
		else if (!empty($uuid))
		{
			$uuid = $uuid;
			$username = $this->getCurrentUsernameFromUuid($uuid);
		}


		$skin = $this->_steveBase64;
		$fileOutput = array(
			'uuid'              => $uuid,
			'username'          => $username,
			'original_cache'    => time(),
			'last_cache'        => time(),
			'skin'              => $skin,
		);
		if (@file_exists($cacheFile))
		{
			$cache = @file_get_contents($cacheFile);
			$data = json_decode($cache, true);
		}
		if ($username && $uuid)
		{
			$fileId = $uuid;
			$skin = $this->getSkinBase64($uuid);
			if ($skin)
			{
				$fileOutput['skin'] = $skin;
			}
			$fileOutput['last_cache'] = time();
		}
		$jsonContents = json_encode($fileOutput);

		$fh = fopen($cacheFile, 'w+');
		fwrite($fh, $jsonContents);
		fclose($fh);

		return $skin;
	}
}