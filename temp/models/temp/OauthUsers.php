<?php

namespace app\models;

use Yii;
use \app\models\base\OauthUsers as BaseOauthUsers;

/**
* This is the model class for table "oauth_users".
*/
class OauthUsers extends BaseOauthUsers implements \yii\web\IdentityInterface,\OAuth2\Storage\UserCredentialsInterface
{
/**
* @inheritdoc
*/
public static function findIdentity($id) {
	$dbUser = OauthUsers::find()->where(["id" => $id])->one();
	if (!count($dbUser)) {
		return null;
	}
	return new static($dbUser);
}

/**
* @inheritdoc
*/
public static function findIdentityByAccessToken($token, $userType = null) {

	$at = OauthAccessTokens::find()->where(["access_token" => $token])->one();
	$dbUser = OauthUsers::find()->where(["id" => $at->user_id])->one();
	if (!count($dbUser)) {
		return null;
	}
	return new static($dbUser);
}

/**
* Implemented for Oauth2 Interface
*/
public function checkUserCredentials($username, $password)
{
	$user = static::findByUsername($username);
	if (empty($user)) {
		return false;
	}
	return $user->validatePassword($password);
}

/**
* Implemented for Oauth2 Interface
*/
public function getUserDetails($username)
{
	$user = static::findByUsername($username);
	return ['user_id' => $user->getId()];
}

/**
* Finds user by username
*
* @param  string      $username
* @return static|null
*/
public static function findByUsername($username) {
	$dbUser = OauthUsers::find()->where(["username" => $username])->one();
	if (!count($dbUser)) {
		return null;
	}
	return new static($dbUser);
}

/**
* @inheritdoc
*/
public function getId()
{
	return $this->id;
}

/**
* @inheritdoc
*/
public function getAuthKey()
{
	return $this->authKey;
}

/**
* @inheritdoc
*/
public function validateAuthKey($authKey)
{
	return $this->authKey === $authKey;
}

/**
* Validates password
*
* @param  string  $password password to validate
* @return boolean if password provided is valid for current user
*/
public function validatePassword($password)
{
	return $this->password === $password;
}
}