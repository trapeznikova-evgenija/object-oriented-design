#include "stdafx.h"
#include "../2.1/Observer.h"
#include "../2.1/WeatherData.h"
#include <vector>
#include <string>

using namespace std;

class CNotifyTests: public IObserver<SWeatherInfo>
{
public:
	CNotifyTests(CObservable<SWeatherInfo>& observable, int observerPriority, vector<int>& prioritiesSet)
		: m_observable(observable),
		m_observer_priority(observerPriority),
		m_priorities_set(prioritiesSet)

	{
	}

private:
	void Update(const SWeatherInfo& data) override
	{
		m_priorities_set.push_back(m_observer_priority);
		m_observable.RemoveObserver(*this);
	}

	CObservable<SWeatherInfo>& m_observable;
	vector<int> &m_priorities_set;
	int m_observer_priority;
};

TEST_CASE("Safely notify observers")
{
	CWeatherData weatherData;

	CHECK(true == true);

};

TEST_CASE("Observer priority testing")
{
	CWeatherData weatherData;
	vector<int> prioritiesSet;
	
	CNotifyTests testObserver1(weatherData, 1, prioritiesSet);
	CNotifyTests testObserver2(weatherData, 2, prioritiesSet);
	CNotifyTests testObserver3(weatherData, 5, prioritiesSet);
	
	weatherData.RegisterObserver(testObserver1, 1);
	weatherData.RegisterObserver(testObserver2, 2);
	weatherData.RegisterObserver(testObserver3, 5);

	weatherData.NotifyObservers();

	string resultPriorityString = "";
	for (int i = 0; i < prioritiesSet.size(); i++)
	{
		resultPriorityString += to_string(prioritiesSet[i]);
	}

	CHECK(resultPriorityString == "125");

};