package com.bjsxt.service;

import com.bjsxt.dao.UserDAO;
import com.bjsxt.model.User;

public class UserService {
	private UserDAO userDAO;
	
	private UserService(UserDAO userDAO) {
		this.userDAO = userDAO;
	}
	
	/*public UserDAO getUserDAO() {
		return userDAO;
	}
	public void setUserDAO(UserDAO userDAO) {
		System.out.println("set");
		this.userDAO = userDAO;
	}*/
	public void add(User user) {
		System.out.println(this.userDAO);
		this.userDAO.save(user);
	}
}
