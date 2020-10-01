package spa;

import java.util.ArrayList;
import java.util.Scanner;

public class Project {

	private int id;
	private int capacity;
	private String code;
	private ArrayList<Student> assignedStudents = new ArrayList<Student>();
	private Lecturer lecturer = null;
	private ArrayList<Student> studentsInPreferenceList = new ArrayList<Student>();

	/*
	 * Reading the project's information
	 */
	Project(int id, Scanner s) {
		this.id = id;
		capacity = s.nextInt();
		code = s.next();
	}
	
	/*
	 * Getting the project's code
	 */
	public String getCode() {
		return code;
	}
	
	/*
	 * Getting the lecturer who offers the project
	 */
	public Lecturer getLecturer() {
		return lecturer;
	}

	/*
	 * Getting the project's ID
	 */
	public int getID() {
		return id;
	}
	
	/*
	 * Setting the lecturer lk who offers the project
	 */
	public void setLecturer(Lecturer lk) {
		this.lecturer = lk;
	}
	
	/*
	 * Adding the student to the lecturer's preference list
	 */
	public void addStudentToList(Student si) {
		this.studentsInPreferenceList.add(si);
	}
	
	/*
	 * Adding the student si to the list of those assigned to the project
	 */
	public void assignStudent(Student si) {
		assignedStudents.add(si);
	}
	
	/*
	 * Return True if the Project has exceeded its capacity, False if not
	 */
	public boolean isOverSubscribed() {
		if (this.assignedStudents.size() > capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/*
	 * Return True if the number of students assigned to the project matches the capacity, False if not
	 */
	public boolean isFull() {
		if (this.assignedStudents.size() == capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/* 
	 * Getting the student that is lowest in the offering Lecturer's preference list
	 */
	public Student getWorstAssignedStudent() {
		int i = 0;
		for (Student si:assignedStudents) {
			if (studentsInPreferenceList.indexOf(si) >= i) {
				i = studentsInPreferenceList.indexOf(si);
			}
		}
		return studentsInPreferenceList.get(i);
	}
	
	/*
	 * Getting a student from their index
	 */
	public int getIndexOfStudent(Student si) {
		return studentsInPreferenceList.indexOf(si);
	}
	
	/*
	 *  Getting the total number of students in the offering lecturer's preference list
	 */
	public int getTotalStudentsInList() {
		return studentsInPreferenceList.size();
	}
	
	/*
	 * Getting the student that has the provided index
	 */
	public Student getStudentByIndex(int index) {
		return studentsInPreferenceList.get(index);
	}
	
	/*
	 * If it is not possible that a stable matching includes a student assigned
	 * to this project, the provisional assignment is broken
	 */
	public void breakProvisionalAssignment(Student si) {
		assignedStudents.remove(si);
	}
}
