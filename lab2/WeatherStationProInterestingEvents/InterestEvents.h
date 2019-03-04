#pragma once
#include <set>
#include <string>

class InterestingEvents
{
public:
	void PushEvent(const std::string& event)
	{
		m_events.insert(event);
	}

	void RemoveEvent(std::string& event)
	{
		m_events.erase(event);
	}

private:
	std::set<std::string> m_events;
};