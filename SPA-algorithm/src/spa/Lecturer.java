package spa;

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Lecturer extends User {

	private int capacity;
	private List<Student> preferenceList;
	private List<Project> listOfProjects;
	private List<Student> listOfSupervisees;
	
	/*
	 * Reading the information of the Lecturer
	 */
	public Lecturer(int id, Scanner s) {
		preferenceList = new ArrayList<Student>();
		listOfProjects = new ArrayList<Project>();
		listOfSupervisees = new ArrayList<Student>();
		setID(id);
		this.capacity = s.nextInt();
		this.setUsername(s.next());
		s.nextLine();
	}
	
	/*
	 * Adding a student to the Lecturer's preference list
	 */
	public void addStudentToPreferenceList(Student si) {
		preferenceList.add(si);
	}
	
	/*
	 * Adding a project to the list of those offered by
	 * the Lecturer
	 */
	public void addProject(Project pj) {
		listOfProjects.add(pj);
	}
	
	/*
	 * Adding a student to the list of those assigned to a project
	 * that belongs to the Lecturer
	 */
	public void addSupervisee(Student si) {
		listOfSupervisees.add(si);
	}
	
	/*
	 * Returning the size of the Lecturer's preference list
	 */
	public int totalPreferences() {
		return preferenceList.size();
	}
	
	/*
	 * Return True if the Lecturer offers this project; False if not
	 */
	public boolean offersProject(Project pj) {
		return listOfProjects.contains(pj);
	}
	
	/*
	 * Returning the size of the lecturer's preference list
	 */
	public int getTotalPreferences() {
		return this.preferenceList.size();
	}
	
	/*
	 * Getting the number of students this Lecturer can supervise
	 */
	public int getCapacity() {
		return capacity;
	}
	
	/*
	 * Setting the number of students this Lecturer can supervise
	 */
	public void setCapacity(int capacity) {
		this.capacity = capacity;
	}
	
	/*
	 * Checking if a Lecturer is able to supervise any more students
	 */
	public boolean isFree() {
		if(listOfSupervisees.size() < capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/*
	 * If it is not possible that a stable matching includes a student assigned
	 * to this project, the provisional assignment is broken
	 */
	public void breakProvisionalAssignment(Student si) {
		this.listOfSupervisees.remove(si);
	}
	
	/*
	 * Checking if the number of students assigned to this Lecturer is greater
	 * than the total capacity allowed by their projects
	 */
	public boolean isOverSubscribed() {
		if(listOfSupervisees.size() > capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/*
	 * Checking if the number of students assigned to this Lecturer matches
	 * the total capacity allowed by their projects
	 */
	public boolean isFull() {
		if(listOfSupervisees.size() == capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/*
	 * Getting the student assigned to this Lecturer who is lowest on the 
	 * preference list
	 */
	public Student getWorstAssignedStudent() {
		int i = -1;
		for(Student si : listOfSupervisees) {
			if(preferenceList.indexOf(si) > i) {
				i = preferenceList.indexOf(si);
			}
		}
		return preferenceList.get(i);
	}
	
	/*
	 * Getting the index of a student
	 */
	public int getStudentIndex(Student si) {
		return preferenceList.indexOf(si);
	}
	
	/*
	 * Getting the number of projects offered by this Lecturer
	 */
	public int getTotalProjects() {
		return listOfProjects.size();
	}
	
	/*
	 * Getting a Student based on the provided index
	 */
	public Student getStudentByIndex(int index) {
		return preferenceList.get(index);
	}
	
	/*
	 * Getting a Project based on the provided index
	 */
	public Project getProjectByIndex(int index) {
		return listOfProjects.get(index);
	}
}
