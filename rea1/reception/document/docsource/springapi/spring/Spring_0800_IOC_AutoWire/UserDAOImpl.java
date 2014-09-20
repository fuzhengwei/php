package com.bjsxt.dao.impl;

import com.bjsxt.dao.UserDAO;
import com.bjsxt.model.User;


public class UserDAOImpl implements UserDAO {
	
	private int daoId;
	
	public int getDaoId() {
		return daoId;
	}

	public void setDaoId(int daoId) {
		this.daoId = daoId;
	}

	public void save(User user) {
		//Hibernate
		//JDBC
		//XML
		//NetWork
		System.out.println("user saved!");
	}
	
	@Override
	public String toString() {
		return "daoId=" + daoId;
	}

}
