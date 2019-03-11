#pragma once
#include <iostream>
#include <vector>
#include <algorithm>
#include <climits>
#include <string>
#include "Observer.h"
#define _USE_MATH_DEFINES
#include <math.h>

using namespace std;

struct SWeatherInfo
{
	double temperature = 0;
	double humidity = 0;
	double pressure = 0;	

	void PrintInfo() 
	{
		std::cout << "Current Temp " << temperature << std::endl;
		std::cout << "Current Hum " << humidity << std::endl;
		std::cout << "Current Pressure " << pressure << std::endl;
	}
};

struct SWeatherInfoPro : public SWeatherInfo
{
	double windSpeed = 0;
	double direction = 0;

	void PrintInfo()
	{
		std::cout << "Current Wind Speed " << windSpeed << std::endl;
		std::cout << "Current Wind Direction " << direction << std::endl;
	}
};

class CDisplay : public IObserver<SWeatherInfo>
{
public:
	CDisplay(CWeatherData& inStation, CWeatherDataPro& outStation)
		: m_inStation(inStation),
		m_outStation(outStation)
	{
	};

private:
	void Update(SWeatherInfo& data, const IObservable<SWeatherInfo>& observable) override
	{
		(&observable == &m_inStation) ? std::cout << "State Position in" << std::endl 
			                          : std::cout << "State Position out" << std::endl;
		data.PrintInfo();
		std::cout << "----------------" << std::endl;
	}

	CWeatherData& m_inStation;
	CWeatherDataPro& m_outStation;
};

class CStatsData
{
public:
	void UpdateStatsData(const double sensorType)
	{
		if (m_minValue > sensorType)
		{
			m_minValue = sensorType;
		}
		if (m_maxValue < sensorType)
		{
			m_maxValue = sensorType;
		}
		m_accValue += sensorType;
		++m_countAcc;
		m_averageValue = m_accValue / m_countAcc;

		PrintStatsValue();
	}

private:
	void PrintStatsValue()
	{
		cout << "Max " << m_maxValue << endl;
		cout << "Min " << m_minValue << std::endl;
		cout << "Average " << m_averageValue << endl;
		cout << "----------------" << endl;
	}

	double m_minValue = numeric_limits<double>::infinity();
	double m_maxValue = -numeric_limits<double>::infinity();
	double m_accValue = 0;
	double m_averageValue = 0;
	unsigned m_countAcc = 0;
};

class CAverageWindDirection
{
public:
	double CalculateAverageWindDirection(const double degree, const double speed)
	{
		double x = cos(degree * M_PI / 180) * speed;
		double y = sin(degree * M_PI / 180) * speed;

		++m_countAcc;

		m_xCoord += x;
		m_yCoord += y;

		return atan2(m_yCoord / m_countAcc, m_xCoord / m_countAcc) * (180 / M_PI);
	}
private:
	double m_xCoord = 0;
	double m_yCoord = 0;
	unsigned m_countAcc = 0;
};

class CStatsDisplay : public IObserver<SWeatherInfo>
{
private:
	CStatsData temperature;
	CStatsData humidity;
	CStatsData pressure;

	void Update(SWeatherInfo& data, const IObservable<SWeatherInfo>& observable) override
	{
		std::cout << "State Position in" << std::endl;

		PrintSensorTypeName("Temperature");
		temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		pressure.UpdateStatsData(data.pressure);
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}
};

class CStatsDisplayPro : public IObserver<SWeatherInfoPro>
{
private:
	void Update(SWeatherInfoPro& data, const IObservable<SWeatherInfoPro>& observable) override
	{
		std::cout << "State Position in" << std::endl;

		PrintSensorTypeName("Temperature");
		m_temperature.UpdateStatsData(data.temperature);

		PrintSensorTypeName("Humidity");
		m_humidity.UpdateStatsData(data.humidity);

		PrintSensorTypeName("Pressure");
		m_pressure.UpdateStatsData(data.pressure);

		PrintSensorTypeName("Wind Speed");
		m_windSpeed.UpdateStatsData(data.windSpeed);

		PrintSensorTypeName("Wind Direction");
		double averageWindDirection = m_windDirection.CalculateAverageWindDirection(data.direction, data.windSpeed);
		cout << "Average " << averageWindDirection << endl;
		cout << "----------------" << endl;
	}

	void PrintSensorTypeName(const string& name)
	{
		cout << name << ": " << endl;
	}

	CStatsData m_temperature;
	CStatsData m_humidity;
	CStatsData m_pressure;
	CStatsData m_windSpeed;
	CAverageWindDirection m_windDirection;
};

class CWeatherData : public CObservable<SWeatherInfo>
{
public:
	double GetTemperature()const
	{
		return m_temperature;
	}
	
	double GetHumidity()const
	{
		return m_humidity;
	}
	
	double GetPressure()const
	{
		return m_pressure;
	}

	std::string GetStationLocation()const
	{
		return m_stationLocation;
	}

	void SetLocationName(std::string const& location)
	{
		m_stationLocation = location;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;

		MeasurementsChanged();
	}
protected:
	SWeatherInfo GetChangedData() const override
	{
		SWeatherInfo info;
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	std::string m_stationLocation;
};

class CWeatherDataPro : public CObservable<SWeatherInfoPro>
{
public:
	double GetTemperature()const
	{
		return m_temperature;
	}

	double GetHumidity()const
	{
		return m_humidity;
	}
	
	double GetPressure()const
	{
		return m_pressure;
	}

	std::string GetStationLocation()const
	{
		return m_stationLocation;
	}

	void SetLocationName(std::string const& location)
	{
		m_stationLocation = location;
	}

	double GetWindSpeed()const
	{
		return m_wind_speed;
	}

	double GetWindDirection()const
	{
		return m_direction;
	}

	void MeasurementsChanged()
	{
		NotifyObservers();
	}

	void SetMeasurements(double temp, double humidity, double pressure, double windSpeed, double direction)
	{
		m_humidity = humidity;
		m_temperature = temp;
		m_pressure = pressure;
		m_direction = direction;
		m_wind_speed = windSpeed;

		MeasurementsChanged();
	}

protected:
	SWeatherInfoPro GetChangedData() const override
	{
		SWeatherInfoPro info;
		info.temperature = GetTemperature();
		info.humidity = GetHumidity();
		info.pressure = GetPressure();
		info.windSpeed = GetWindSpeed();
		info.direction = GetWindDirection();
		return info;
	}
private:
	double m_temperature = 0.0;
	double m_humidity = 0.0;
	double m_pressure = 760.0;
	double m_wind_speed = 0;
	double m_direction = 0;
	std::string m_stationLocation;
};

