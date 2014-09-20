package com.bjsxt.dao.impl;

import com.bjsxt.dao.UserDAO;
import com.bjsxt.model.User;

public class UserDAOImpl implements UserDAO {
	/* (non-Javadoc)
	 * @see com.bjsxt.dao.UserDAO#save(com.bjsxt.model.User)
	 */
	
	private int daoId;
	private String daoStatus;
	
	public int getDaoId() {
		return daoId;
	}

	public void setDaoId(int daoId) {
		this.daoId = daoId;
	}

	public String getDaoStatus() {
		return daoStatus;
	}

	public void setDaoStatus(String daoStatus) {
		this.daoStatus = daoStatus;
	}

	public void save(User user) {
		System.out.println("user saved!");
	}
	
	@Override
	public String toString() {
		return this.daoId + ":" + this.daoStatus;
	}
}
