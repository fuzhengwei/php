package com.bjsxt.registration.service;

import java.util.List;

import com.bjsxt.registration.model.User;

public interface UserManager {

	public abstract boolean exists(User u) throws Exception;

	public abstract void add(User u) throws Exception;
	
	public List<User> getUsers();
	
	public User loadById(int id);

}